<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $cartService;
    protected $stockService;

    public function __construct(CartService $cartService, StockService $stockService)
    {
        $this->cartService = $cartService;
        $this->stockService = $stockService;
    }

    public function placeOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            $cartItems = $this->cartService->getCart();

            if ($cartItems->isEmpty()) {
                throw new \Exception("Le panier est vide.");
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => 0, // Will update after adding items
                'subtotal' => 0,
                'tax_amount' => 0,
                'shipping_amount' => $data['shipping_amount'] ?? 0,
                'status' => 'en_attente',
                'delivery_address' => $data['delivery_address'],
                'payment_method' => $data['payment_method'],
                'payment_status' => 'en_attente',
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'variant_id' => $item->variant_id,
                    'product_name' => $item->variant->product->name,
                    'variant_details' => $item->variant->attributeValues->pluck('value', 'attribute.name'),
                    'quantity' => $item->quantity,
                    'unit_price' => $item->variant->price,
                    'total_price' => $item->subtotal(),
                ]);

                // Reduce stock
                $this->stockService->removeStock($item->variant_id, $item->quantity, "Vente commande #{$order->order_number}");
            }

            $order->calculateTotals();
            $this->cartService->clear();

            return $order;
        });
    }

    public function getWhatsAppLink(Order $order)
    {
        $phoneNumber = "22997587762";
        $message = "🔹 *NOUVELLE COMMANDE ElecShop*\n\n";
        $message .= "Bonjour, je souhaite confirmer ma commande *#{$order->order_number}*.\n\n";
        $message .= "📦 *Détails des produits :*\n";

        foreach ($order->items as $item) {
            $price = number_format($item->unit_price, 0, ',', ' ');
            $total = number_format($item->total_price, 0, ',', ' ');
            $message .= "• {$item->product_name} (x{$item->quantity})\n";
            $message .= "  ↳ {$total} FCFA\n";
        }

        $totalOrder = number_format($order->total_amount, 0, ',', ' ');
        $message .= "\n💰 *TOTAL : {$totalOrder} FCFA*\n\n";
        $message .= "📍 *Adresse de livraison :*\n{$order->delivery_address}\n\n";
        $message .= "Merci de me confirmer la réception de ma commande !";

        return "https://wa.me/{$phoneNumber}?text=" . rawurlencode($message);
    }
}

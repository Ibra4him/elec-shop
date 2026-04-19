<?php

namespace App\Livewire;

use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Checkout - ElecShop')]
#[Layout('layouts.app')]
class CheckoutPage extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $delivery_address = '';
    public $notes = '';
    public $payment_method = 'cash_on_delivery';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:8',
        'delivery_address' => 'required|min:10',
        'payment_method' => 'required|in:cash_on_delivery,bank_transfer',
    ];

    public function mount()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $this->name = $user->name;
            $this->email = $user->email;
            // Assuming phone or address might exist if they were saved before
            // but for now let's just keep it simple
        }
    }

    public function placeOrder(CartService $cartService, OrderService $orderService)
    {
        $this->validate();

        $cart = $cartService->getCart();

        if ($cart->isEmpty()) {
            session()->flash('error', 'Votre panier est vide.');
            return redirect()->route('shop');
        }

        try {
            $order = $orderService->placeOrder([
                'delivery_address' => "Nom: {$this->name}\nEmail: {$this->email}\nTél: {$this->phone}\n\nAdresse:\n{$this->delivery_address}",
                'payment_method' => $this->payment_method,
                'notes' => $this->notes,
                'shipping_amount' => 0, // Could be calculated based on address later
            ]);

            return redirect()->route('order.success', $order->order_number);
        } catch (\Exception $e) {
            session()->flash('error', 'Une erreur est survenue lors de la commande : ' . $e->getMessage());
        }
    }

    public function render(CartService $cartService)
    {
        return view('livewire.checkout-page', [
            'cartItems' => $cartService->getCart(),
            'total' => $cartService->getTotal(),
        ]);
    }
}

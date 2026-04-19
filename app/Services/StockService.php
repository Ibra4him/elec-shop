<?php

namespace App\Services;

use App\Models\ProductVariant;
use App\Models\StockMovement;

class StockService
{
    public function addStock(int $variantId, int $quantity, string $reason = 'Réassort', ?string $reference = null)
    {
        return StockMovement::create([
            'variant_id' => $variantId,
            'quantity' => abs($quantity),
            'type' => 'entree',
            'reason' => $reason,
            'reference' => $reference,
            'user_id' => auth()->id(),
        ]);
    }

    public function removeStock(int $variantId, int $quantity, string $reason = 'Vente', ?string $reference = null)
    {
        $variant = ProductVariant::findOrFail($variantId);
        
        if ($variant->stock_qty < abs($quantity)) {
            throw new \Exception("Stock insuffisant pour la variante SKU: {$variant->sku}");
        }

        return StockMovement::create([
            'variant_id' => $variantId,
            'quantity' => -abs($quantity),
            'type' => 'sortie',
            'reason' => $reason,
            'reference' => $reference,
            'user_id' => auth()->id(),
        ]);
    }

    public function adjustStock(int $variantId, int $newQuantity, string $reason = 'Ajustement manuel')
    {
        if ($newQuantity < 0) {
            throw new \Exception("Le stock ne peut pas être négatif.");
        }

        return StockMovement::create([
            'variant_id' => $variantId,
            'quantity' => $newQuantity,
            'type' => 'ajustement',
            'reason' => $reason,
            'user_id' => auth()->id(),
        ]);
    }
}

<?php

namespace App\Observers;

use App\Models\StockMovement;

class StockMovementObserver
{
    /**
     * Handle the StockMovement "created" event.
     */
    public function created(StockMovement $stockMovement): void
    {
        $variant = $stockMovement->variant;
        $quantity = abs($stockMovement->quantity);

        switch ($stockMovement->type) {
            case 'entree':
            case 'retour':
                $variant->increment('stock_qty', $quantity);
                break;
            case 'sortie':
                $variant->decrement('stock_qty', $quantity);
                break;
            case 'ajustement':
                $variant->stock_qty = $stockMovement->quantity;
                $variant->save();
                break;
        }

        // Check for low stock after the movement
        if ($variant->stock_qty <= $variant->min_stock) {
            $admins = \App\Models\User::where('role', 'admin')->get();
            if ($admins->isEmpty()) {
                $admins = \App\Models\User::take(1)->get(); // Fallback to first user
            }
            
            \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\LowStockAlert($variant));
        }
    }
}

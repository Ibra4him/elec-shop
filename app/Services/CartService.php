<?php

namespace App\Services;

use App\Models\CartItem;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getCart()
    {
        $userId = auth()->id();
        $sessionId = Session::getId();

        return CartItem::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->with('variant.product')->get();
    }

    public function addItem(int $variantId, int $quantity = 1)
    {
        $userId = auth()->id();
        $sessionId = Session::getId();

        $cartItem = CartItem::where('variant_id', $variantId)
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            CartItem::create([
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
                'variant_id' => $variantId,
                'quantity' => $quantity,
            ]);
        }
    }

    public function removeItem(int $cartItemId)
    {
        CartItem::findOrFail($cartItemId)->delete();
    }

    public function clear()
    {
        $userId = auth()->id();
        $sessionId = Session::getId();

        CartItem::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->delete();
    }

    public function getTotal()
    {
        return $this->getCart()->sum(fn($item) => $item->subtotal());
    }
}

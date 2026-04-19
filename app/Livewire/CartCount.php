<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;

class CartCount extends Component
{
    protected $listeners = ['cart-updated' => '$refresh'];

    public function render(CartService $cartService)
    {
        $count = $cartService->getCart()->sum('quantity');

        return view('livewire.cart-count', compact('count'));
    }
}

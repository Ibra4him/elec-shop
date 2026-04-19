<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use App\Services\CartService;
use Livewire\Component;

class CartSidebar extends Component
{
    public $isOpen = false;

    #[On('cart-updated')]
    public function refreshCart()
    {
        // Component will auto-refresh
    }

    #[On('open-cart')]
    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function removeItem($id, CartService $cartService)
    {
        $cartService->removeItem($id);
        $this->dispatch('cart-updated');
    }

    public function render(CartService $cartService)
    {
        return view('livewire.cart-sidebar', [
            'cartItems' => $cartService->getCart(),
            'total' => $cartService->getTotal(),
        ]);
    }
}

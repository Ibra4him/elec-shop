<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\CartService;
use Livewire\Component;

class ProductPicker extends Component
{
    public Product $product;
    public $selectedVariantId;
    public $quantity = 1;
    public $currentVariant;

    public function mount(Product $product)
    {
        $this->product = $product;
        // Sélectionne la variante principale par défaut (ou la seule si produit simple)
        $this->currentVariant = $product->getMainVariant();
        if ($this->currentVariant) {
            $this->selectedVariantId = $this->currentVariant->id;
        }
    }

    public function updatedSelectedVariantId($value)
    {
        $this->currentVariant = ProductVariant::find($value);
    }

    public function addToCart(CartService $cartService)
    {
        if (!$this->currentVariant) return;

        $cartService->addItem($this->currentVariant->id, $this->quantity);

        $this->dispatch('cart-updated');
        $this->dispatch('open-cart'); // Show cart sidebar
        
        session()->flash('success', 'Produit ajouté au panier !');
    }

    public function render()
    {
        return view('livewire.product-picker');
    }
}

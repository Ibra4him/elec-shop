<?php

namespace App\Livewire;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavoriteButton extends Component
{
    public $productId;
    public $isFavorited = false;
    public $variant = 'default'; // 'default' for cards, 'large' for product page

    public function mount($productId, $variant = 'default')
    {
        $this->productId = $productId;
        $this->variant = $variant;
        $this->checkFavorite();
    }

    public function checkFavorite()
    {
        if (Auth::check()) {
            $this->isFavorited = Favorite::where('user_id', Auth::id())
                ->where('product_id', $this->productId)
                ->exists();
        }
    }

    public function toggleFavorite()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isFavorited) {
            Favorite::where('user_id', Auth::id())
                ->where('product_id', $this->productId)
                ->delete();
            $this->isFavorited = false;
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $this->productId,
            ]);
            $this->isFavorited = true;
        }

        $this->dispatch('favoriteUpdated');
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}

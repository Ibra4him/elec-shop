<?php

namespace App\Livewire;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavoritesPage extends Component
{
    public function render()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('product.brand', 'product.category')
            ->latest()
            ->get();

        return view('livewire.favorites-page', [
            'favorites' => $favorites
        ])->layout('layouts.app');
    }
}

<?php

namespace App\Livewire;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavoritesCount extends Component
{
    public $count = 0;

    protected $listeners = ['favoriteUpdated' => 'refreshCount'];

    public function mount()
    {
        $this->refreshCount();
    }

    public function refreshCount()
    {
        if (Auth::check()) {
            $this->count = Favorite::where('user_id', Auth::id())->count();
        } else {
            $this->count = 0;
        }
    }

    public function render()
    {
        return view('livewire.favorites-count');
    }
}

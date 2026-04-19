<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    public $selectedCategories = [];
    public $selectedBrands = [];
    public $minPrice = 0;
    public $maxPrice = 10000000;
    public $search = '';
    public $sortBy = 'latest';

    protected $queryString = [
        'selectedCategories' => ['except' => [], 'as' => 'categories'],
        'selectedBrands' => ['except' => [], 'as' => 'brands'],
        'search' => ['except' => ''],
    ];

    public function updating($property)
    {
        if (in_array($property, ['selectedCategories', 'selectedBrands', 'minPrice', 'maxPrice', 'search', 'sortBy'])) {
            $this->resetPage();
        }
    }

    public function resetFilters()
    {
        $this->reset(['selectedCategories', 'selectedBrands', 'minPrice', 'maxPrice', 'search', 'sortBy']);
    }

    public function render()
    {
        $query = Product::where('status', 'actif')
            ->with(['brand', 'category', 'variants']);

        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        if (!empty($this->selectedBrands)) {
            $query->whereIn('brand_id', $this->selectedBrands);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->minPrice > 0 || $this->maxPrice < 10000000) {
            $query->whereBetween('base_price', [$this->minPrice, $this->maxPrice]);
        }

        switch ($this->sortBy) {
            case 'price_asc':
                $query->orderBy('base_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('base_price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        return view('livewire.shop-page', [
            'products' => $query->paginate(12),
            'categories' => Category::where('is_active', true)->withCount('products')->get(),
            'brands' => Brand::where('is_active', true)->withCount('products')->get(),
        ]);
    }
}

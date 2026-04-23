<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('status', 'actif')
            ->with(['brand', 'category', 'variants'])
            ->take(8)
            ->get();

        $rootCategories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        $brands = \App\Models\Brand::where('is_active', true)->get();

        return view('welcome', compact('featuredProducts', 'rootCategories', 'brands'));
    }
}

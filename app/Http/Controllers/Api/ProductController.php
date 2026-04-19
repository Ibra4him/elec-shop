<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\ProductFilterService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $filterService;

    public function __construct(ProductFilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function index(Request $request)
    {
        $query = $this->filterService->filter($request->all());
        
        $products = $query->with(['category', 'brand', 'variants.attributeValues.attribute'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->paginate($request->get('limit', 12));

        return ProductResource::collection($products);
    }

    public function show($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)
            ->active()
            ->with(['category', 'brand', 'variants.attributeValues.attribute', 'specifications'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->firstOrFail();

        return new ProductResource($product);
    }

    public function featured()
    {
        $products = \App\Models\Product::featured()
            ->active()
            ->with(['category', 'brand', 'variants'])
            ->withAvg('reviews', 'rating')
            ->take(8)
            ->get();

        return ProductResource::collection($products);
    }
}

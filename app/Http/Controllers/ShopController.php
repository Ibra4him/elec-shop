<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('shop');
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'actif')
            ->with(['brand', 'category', 'variants.attributeValues.attribute', 'specifications'])
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'actif')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function orderSuccess($orderNumber, OrderService $orderService)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with('items.variant.product')
            ->firstOrFail();
            
        $whatsappLink = $orderService->getWhatsAppLink($order);
        
        return view('orders.success', compact('order', 'whatsappLink'));
    }
}

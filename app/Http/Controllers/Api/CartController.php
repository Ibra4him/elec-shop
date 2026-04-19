<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        return response()->json([
            'items' => $this->cartService->getCart(),
            'total' => $this->cartService->getTotal(),
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'integer|min:1',
        ]);

        $this->cartService->addItem($request->variant_id, $request->get('quantity', 1));

        return response()->json(['message' => 'Produit ajouté au panier.']);
    }

    public function remove($id)
    {
        $this->cartService->removeItem($id);
        return response()->json(['message' => 'Produit retiré du panier.']);
    }

    public function clear()
    {
        $this->cartService->clear();
        return response()->json(['message' => 'Panier vidé.']);
    }
}

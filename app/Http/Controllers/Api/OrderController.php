<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        try {
            $order = $this->orderService->placeOrder($request->all());
            
            return response()->json([
                'message' => 'Commande passée avec succès.',
                'order' => new OrderResource($order->load('items')),
                'whatsapp_link' => $this->orderService->getWhatsAppLink($order),
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function index(Request $request)
    {
        $orders = $request->user()->orders()->with('items')->latest()->paginate(10);
        return OrderResource::collection($orders);
    }

    public function show(Request $request, $orderNumber)
    {
        $order = $request->user()->orders()
            ->where('order_number', $orderNumber)
            ->with('items')
            ->firstOrFail();

        return new OrderResource($order);
    }
}

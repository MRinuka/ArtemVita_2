<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        // Transform the orders to ensure product details exist
        $orders->transform(function ($order) {
            return [
                'id' => $order->id,
                'status' => $order->status,
                'product_name' => $order->product_name ?? 'Deleted Product',
                'price' => $order->price ?? 'N/A',
                'painting_url' => $order->product?->painting_url ?? 'products/default.jpg', // Fallback image
            ];
        });

        return response()->json([
            'orders' => $orders
        ]);
    }

}

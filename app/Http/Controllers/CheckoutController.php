<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show($id)
    {
        // Fetch the product details
        $product = Product::findOrFail($id);

        // Return a view for checkout
        return view('orders.checkout', compact('product'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'product_ids' => 'required|array',
        ]);

        foreach ($request->product_ids as $productId) {
            $product = Product::find($productId);
            
            if ($product) {
                // Create order before deleting the product
                Order::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'product_name' => $product->product_name, // Store product name before deletion
                    'price' => $product->price, // Store price before deletion
                    'address' => $request->address,
                    'status' => 'Pending',
                ]);

                // Delete product from database
                $product->delete();
            }
        }

        return redirect()->route('orders.history')->with('success', 'Order placed successfully!');
    }

    
    public function cartCheckout()
    {
        // Get the cart items for the authenticated user
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // If there are no cart items, redirect back
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        // Calculate the total price and pass it to the view
        $totalPrice = $cartItems->sum('price');

        return view('orders.cart_checkout', compact('cartItems', 'totalPrice'));
    }


    public function history()
    {
        // Get all orders for the authenticated user
        $orders = Order::where('user_id', Auth::id())->get();

        // Pass the orders to the view
        return view('orders.history', compact('orders'));
    }


}

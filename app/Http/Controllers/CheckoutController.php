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
                
                Order::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'product_name' => $product->product_name, 
                    'price' => $product->price, 
                    'address' => $request->address,
                    'status' => 'Pending',
                ]);

                
                $product->delete();
            }
        }

        return redirect()->route('orders.history')->with('success', 'Order placed successfully!');
    }

    
    public function cartCheckout()
    {
        
        $cartItems = Cart::where('user_id', Auth::id())->get();

        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        
        $totalPrice = $cartItems->sum('price');

        return view('orders.cart_checkout', compact('cartItems', 'totalPrice'));
    }


    public function history()
    {
        
        $orders = Order::where('user_id', Auth::id())->get();

        return view('orders.history', compact('orders'));
    }


}

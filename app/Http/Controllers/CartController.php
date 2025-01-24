<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Validate the product_id input
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Add the product to the user's cart
        $cart = new Cart();
        $cart->user_id = Auth::id(); // Logged-in user ID
        $cart->product_id = $request->product_id;
        $cart->quantity = 1; // Default quantity
        $cart->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}

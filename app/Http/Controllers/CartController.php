<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if (!$existingCartItem) {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ]);
        }

        // Set a session flash message
        session()->flash('cartUpdated', true);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function showCart()
    {
        return view('cart');  // Just return the view, no data passed here
    }


    public function removeFromCart($productId)
    {
        $userId = Auth::id();

        Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        return redirect()->route('cart.show')->with('success', 'Product removed from cart.');
    }
}

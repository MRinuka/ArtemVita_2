<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show($id)
    {
        // Fetch the product details
        $product = Product::findOrFail($id);

        // Return a view for checkout
        return view('checkout', compact('product'));
    }

    public function process(Request $request)
    {
        // Validate checkout form data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'address' => 'required|string|max:255',
        ]);

        // Create an order
        $order = new Order();
        $order->user_id = Auth::id(); // Logged-in user ID
        $order->product_id = $request->product_id;
        $order->address = $request->address;
        $order->status = 'Pending'; // Default status
        $order->save();

        // Redirect to a success page
        return redirect('/')->with('success', 'Order placed successfully!');
    }
}

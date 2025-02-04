<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    // Fetch product details for checkout
    public function show($id)
    {
        // Find product by ID or return 404
        $product = Product::findOrFail($id);

        // Return JSON response for product details
        return response()->json([
            'product' => $product
        ], 200);
    }

    // Process the checkout
    


public function process(Request $request)
{
    // Validate the incoming request
    $validatedData = $request->validate([
        'product_id' => 'required|exists:products,id',
        'address' => 'required|string|max:255',
    ]);

    // Get the authenticated user
    $user = Auth::user();  // Here you retrieve the logged-in user

    // Start the transaction
    DB::beginTransaction();

    try {
        // Create a new order
        $order = new Order();
        $order->user_id = $user->id;  // Use the authenticated user
        $order->product_id = $validatedData['product_id'];
        $order->address = $validatedData['address'];
        $order->status = 'Pending'; // Default status
        $order->save();

        // Load product relationship (optional)
        $order->load('product');

        // Attempt to delete the product
        $product = Product::find($validatedData['product_id']);

        if (!$product) {
            throw new \Exception("Product not found: ID " . $validatedData['product_id']);
        }

        $product->delete();

        // Commit transaction
        DB::commit();

        return response()->json([
            'message' => 'Order placed successfully!',
            'order' => $order
        ], 201);

    } catch (\Exception $e) {
        // Rollback transaction if any error occurs
        DB::rollBack();

        // Log the error for debugging
        Log::error("Order Process Error: " . $e->getMessage());

        return response()->json([
            'message' => 'Failed to process order',
            'error' => $e->getMessage()
        ], 500);
    }
}

}

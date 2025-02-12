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
    
    public function show($id)
    {
        // Find product by ID or return 404
        $product = Product::findOrFail($id);

        
        return response()->json([
            'product' => $product
        ], 200);
    }

   
    


    public function process(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Start a transaction to ensure data consistency
        DB::beginTransaction();
    
        try {
            // Retrieve the product
            $product = Product::find($validatedData['product_id']);
    
            if (!$product) {
                return response()->json([
                    'message' => 'Product not found',
                ], 404);
            }
    
            // Create the order and properly reference the product
            $order = new Order([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'product_name' => $product->product_name, 
                'price' => $product->price, 
                'address' => $validatedData['address'],
                'status' => 'Pending',
            ]);
            
            $order->save();
    
            // Load the product relationship
            $order->load('product');
    
            // Delete the product after creating the order
            $product->delete();
    
            // Commit the transaction
            DB::commit();
    
            return response()->json([
                'message' => 'Order placed successfully!',
                'order' => $order
            ], 201);
    
        } catch (\Exception $e) {
            // Rollback transaction in case of failure
            DB::rollBack();
    
            return response()->json([
                'message' => 'Failed to process order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

}

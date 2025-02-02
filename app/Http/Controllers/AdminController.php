<?php

namespace App\Http\Controllers;

use App\Models\ProductRequests;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    

    public function index()
    {
        // Fetch up to 3 product requests
        $productRequests = ProductRequests::where('status', 'pending')->get();  // Or use another method to get them

        return view('admin.home', compact('productRequests'));
    }

    public function users()
    {
        // Retrieve all users ordered by last login (if available)
        $users = User::orderBy('updated_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function productRequests()
    {
        // Get all product requests that are pending
        $productRequests = ProductRequests::where('status', 'pending')->get();
        return view('admin.product_requests', compact('productRequests'));
    }

    public function acceptProductRequest($id)
    {
        // Find the product request
        $productRequest = ProductRequests::findOrFail($id);

        // Create a product from the accepted request
        $product = new Product();
        $product->product_name = $productRequest->product_name;
        $product->price = $productRequest->price;
        $product->description = $productRequest->description;
        $product->painting_url = $productRequest->painting_url;
        $product->seller_id = $productRequest->seller_id;
        $product->save();

        // Update the product request status to 'accepted'
        $productRequest->status = 'accepted';
        $productRequest->save();

        return redirect()->route('admin.product_requests')->with('success', 'Product accepted and added!');
    }

    public function declineProductRequest($id)
    {
        // Find the product request and update its status to 'declined'
        $productRequest = ProductRequests::findOrFail($id);
        $productRequest->status = 'declined';
        $productRequest->save();

        return redirect()->route('admin.product_requests')->with('error', 'Product request declined.');
    }

    public function products()
    {
        // Fetch all products
        $products = Product::all();

        // Return the view with the products data
        return view('admin.products', compact('products'));
    }

}

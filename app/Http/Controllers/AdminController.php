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
        $productRequests = ProductRequests::where('status', 'pending')->get();  

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

        
        $product = new Product();
        $product->product_name = $productRequest->product_name;
        $product->price = $productRequest->price;
        $product->description = $productRequest->description;
        $product->painting_url = $productRequest->painting_url;
        $product->seller_id = $productRequest->seller_id;
        $product->save();

        
        $productRequest->status = 'accepted';
        $productRequest->save();

        return redirect()->route('admin.product_requests')->with('success', 'Product accepted and added!');
    }

    public function declineProductRequest($id)
    {
        
        $productRequest = ProductRequests::findOrFail($id);
        $productRequest->status = 'declined';
        $productRequest->save();

        return redirect()->route('admin.product_requests')->with('error', 'Product request declined.');
    }

    public function products()
    {
        
        $products = Product::all();

        // Return the view with the products data
        return view('admin.products', compact('products'));
    }

}

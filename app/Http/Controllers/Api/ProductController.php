<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'painting_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('paintings', 'public');

        $product = new Product();
        $product->product_name = $validatedData['painting_name'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'];
        $product->painting_url = 'paintings/' . basename($imagePath);
        $product->seller_id = Auth::id();
        $product->save();

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

}

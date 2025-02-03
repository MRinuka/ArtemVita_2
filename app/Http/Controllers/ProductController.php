<?php
// In app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductRequests;
use App\Models\User;


class ProductController extends Controller
{
    public function home()
    {
        // Fetch three products
        $popularArtists = User::whereHas('products')->take(3)->get();
    
        // Fetch products as usual
        $products = Product::latest()->take(6)->get(); // Example: Fetch latest 6 products
    
        return view('Home', compact('products', 'popularArtists'));
    }

    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass the products to the view
        
        return view('products_page', compact('products'));
    }


    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'painting_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Store the image
        $imagePath = $request->file('image')->store('paintings', 'public');

        // Create the product request record
        $productRequests = new ProductRequests();
        $productRequests->product_name = $validatedData['painting_name'];
        $productRequests->price = $validatedData['price'];
        $productRequests->description = $validatedData['description'];
        $productRequests->painting_url = 'paintings/' . basename($imagePath); // Save just the relative path
        $productRequests->seller_id = Auth::id(); // Assign the logged-in user's ID as seller_id
        $productRequests->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product request submitted for approval!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Ensure only the product owner can delete it
        if ($product->seller_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Delete the product image from storage
        Storage::disk('public')->delete($product->painting_url);

        // Delete the product from the database
        $product->delete();

        return redirect('/hub')->with('success', 'Product deleted successfully.');
    }


    public function show($id)
    {
        // Fetch the product by its ID
        $product = Product::findOrFail($id);

        // Pass the product to the detailed view
        return view('product_details', compact('product'));
    }

    public function painting_dashboard()
    {
        return view('artist.painting_dashboard');
    }

    public function artist_products($id)
    {
        $artist = User::with('products')->findOrFail($id);
        return view('artist.show', compact('artist'));
    }

    
    public function userHub()
    {
        $userId = auth()->id(); // Get the logged-in user's ID
        $products = Product::where('seller_id', $userId)->get(); // Fetch products uploaded by the user

        return view('user_hub', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // Ensure only the product owner can edit it
        if ($product->seller_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        return view('edit_product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Ensure only the product owner can update it
        if ($product->seller_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'painting_url' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Update fields
        $product->product_name = $validatedData['product_name'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'];

        // Handle file upload if a new image is provided
        if ($request->hasFile('painting_url')) {
            // Delete the old image
            Storage::disk('public')->delete($product->painting_url);

            // Save the new image
            $path = $request->file('painting_url')->store('products', 'public');
            $product->painting_url = $path;
        }

        $product->save();

        return redirect('/hub')->with('success', 'Product updated successfully.');
    }





}

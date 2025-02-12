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
        
        $popularArtists = User::whereHas('products')->take(3)->get();
    
        
        $products = Product::latest()->take(6)->get(); 
    
        return view('Home', compact('products', 'popularArtists'));
    }

    public function index()
    {
        
        $products = Product::all();

        
        
        return view('products_page', compact('products'));
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

        
        $productRequests = new ProductRequests();
        $productRequests->product_name = $validatedData['painting_name'];
        $productRequests->price = $validatedData['price'];
        $productRequests->description = $validatedData['description'];
        $productRequests->painting_url = 'paintings/' . basename($imagePath); 
        $productRequests->seller_id = Auth::id(); 
        $productRequests->save();

        
        return redirect()->back()->with('success', 'Product request submitted for approval!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        
        if ($product->seller_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        
        Storage::disk('public')->delete($product->painting_url);

        
        $product->delete();

        return redirect('/hub')->with('success', 'Product deleted successfully.');
    }


    public function show($id)
    {
        
        $product = Product::findOrFail($id);

        
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
        $userId = auth()->id();

        
        $products = Product::where('seller_id', $userId)->get();

        // Fetch products that have been sold 
        $soldProducts = Product::where('seller_id', $userId)
                            ->whereHas('orders') 
                            ->get();

        return view('artist.user_hub', compact('products', 'soldProducts'));
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // Ensure only the product owner can edit it
        if ($product->seller_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        return view('artist.edit_product', compact('product'));
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

        
        if ($request->hasFile('painting_url')) {
            
            Storage::disk('public')->delete($product->painting_url);

            
            $path = $request->file('painting_url')->store('products', 'public');
            $product->painting_url = $path;
        }

        $product->save();

        return redirect()->route('products.edit', $product->id)->with('success', 'Product updated successfully.');
    }





}

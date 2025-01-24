@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('header')
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Painting Image -->
        <img 
            src="{{ asset('storage/' . $product->painting_url) }}" 
            alt="{{ $product->product_name }}" 
            class="w-full h-64 object-cover rounded-lg mb-6"
        />

        <!-- Painting Details -->
        <h1 class="text-3xl font-bold">{{ $product->product_name }}</h1>
        <p class="text-gray-700 text-xl mt-4">Price: ${{ $product->price }}</p>
        <p class="text-gray-500 mt-4">{{ $product->description }}</p>

        <!-- Add to Cart or Buy Now -->
        <div class="mt-6 flex space-x-4">
            <!-- Add to Cart Button -->
            <form action="/cart/add" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" 
                        class="w-full bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                    Add to Cart
                </button>
            </form>

            <!-- Buy Now Button -->
            <form action="/checkout/{{ $product->id }}" method="GET" class="w-full">
                <button type="submit" 
                        class="w-full bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
                    Buy Now
                </button>
            </form>
        </div>

        <!-- Back Button -->
        <a href="/products" 
           class="mt-6 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
            Back to Gallery
        </a>
    </div>
</div>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('header')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Browse Paintings</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
        <div class="bg-white shadow-lg rounded-lg p-4">
            <!-- Painting Image -->
            <img 
            src="{{ asset('storage/' . $product->painting_url) }}" 
            alt="{{ $product->product_name }}" 
            class="w-full h-48 object-cover rounded-lg mb-4"
            />

            
            <!-- Painting Details -->
            <h2 class="text-xl font-semibold">{{ $product->product_name }}</h2>
            <p class="text-gray-700 mt-2">${{ $product->price }}</p>
            <p class="text-gray-500 mt-2">{{ Str::limit($product->description, 100) }}</p>
            
            <!-- View Button -->
            <a href="{{ route('product.show', $product->id) }}" 
                class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                 Buy Now
             </a>
             
        </div>
        @endforeach
    </div>
</div>
    
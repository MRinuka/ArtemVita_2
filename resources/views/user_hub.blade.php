@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('header')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Your Products</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
        <div class="bg-white shadow-lg rounded-lg p-4">
            <!-- Painting Image -->
            <img 
                src="{{ asset('storage/' . $product->painting_url) }}" 
                alt="{{ $product->product_name }}" 
                class="w-full h-48 object-cover rounded-lg mb-4"
            />

            <!-- Product Details -->
            <h2 class="text-xl font-semibold">{{ $product->product_name }}</h2>
            <p class="text-gray-700 mt-2">${{ $product->price }}</p>
            <p class="text-gray-500 mt-2">{{ Str::limit($product->description, 100) }}</p>

            <!-- Actions -->
            <div class="mt-4 flex space-x-4">
                <!-- Edit Button -->
                <a href="/products/{{ $product->id }}/edit" 
                   class="flex-1 bg-blue-500 text-white px-4 py-2 h-12 rounded-lg hover:bg-blue-600 transition text-center flex items-center justify-center">
                    Edit
                </a>

                <!-- Delete Button -->
                <form action="/products/{{ $product->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full bg-red-500 text-white px-4 py-2 h-12 rounded-lg hover:bg-red-600 transition flex items-center justify-center">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

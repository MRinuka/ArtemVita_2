@extends('layouts.customer')

@section('title', $product->product_name)

@section('content')
<div class="container mx-auto mt-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

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

        <div class="mt-6 flex space-x-4">
            <!-- Add to Cart Button -->
            <form action="{{ route('cart.add') }}" method="POST" class="w-1/2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="w-full bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                    Add to Cart
                </button>
            </form>
        
            <!-- Buy Now Button -->
            <form action="/checkout/{{ $product->id }}" method="GET" class="w-1/2">
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

    <!-- Artist's Other Products -->
    @if($product->artist && $product->artist->products->count() > 1)
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Other Artworks by {{ $product->artist->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($product->artist->products->where('id', '!=', $product->id) as $otherProduct)
                    <a href="{{ route('product.show', $otherProduct->id) }}" class="bg-white shadow-lg rounded-lg p-4 hover:shadow-xl transition">
                        <div>
                            <img src="{{ asset('storage/' . $otherProduct->painting_url) }}" 
                                class="w-full h-48 object-cover rounded-lg mb-4"
                                alt="{{ $otherProduct->product_name }}">
                            <h3 class="text-xl font-semibold">{{ $otherProduct->product_name }}</h3>
                            <p class="text-gray-700 mt-2">${{ $otherProduct->price }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>

@if(session('cartUpdated'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Livewire.emit('cartUpdated');
        });
    </script>
@endif
@endsection

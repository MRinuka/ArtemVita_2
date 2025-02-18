@extends('layouts.customer')

@section('title', 'Welcome to ArtemVita')

@section('content')



{{-- Hero Section --}}
<div class="relative w-full h-[400px]">
    {{-- Hero Image --}}
    <img 
        src="{{ asset('images/pexels-steve-1109354.jpg') }}" 
        alt="Hero Image" 
        class="w-full h-full object-cover"
    >

    {{-- Text Overlay --}}
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="text-center text-white">
            <h1 class="text-4xl font-bold mb-4">Welcome To ArtemVita</h1>
            <p class="text-lg">Browse our collection of beautiful paintings and find your next masterpiece.</p>
        </div>
    </div>
</div>

{{-- Featured Products Section --}}
<div class="container mx-auto mt-12">
    <h2 class="text-2xl font-bold mb-6">Featured Paintings</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <a href="{{ route('product.show', $product->id) }}" class="bg-white shadow-lg rounded-lg p-4 block hover:shadow-xl transition">
                <!-- Painting Image -->
                <img 
                    src="{{ asset('storage/' . $product->painting_url) }}" 
                    alt="{{ $product->product_name }}" 
                    class="w-full h-48 object-cover rounded-lg mb-4"
                />

                <!-- Painting Details -->
                <h3 class="text-xl font-semibold">{{ $product->product_name }}</h3>
                <p class="text-gray-700 mt-2">${{ $product->price }}</p>
                <p class="text-gray-500 mt-2">{{ Str::limit($product->description, 50) }}</p>
            </a>
        @endforeach

    </div>
</div>

{{-- Other sections --}}


<div class="container mx-auto mt-12">
    
</div>
{{-- Popular Artists Section --}}
<div class="container mx-auto mt-12">
    <h2 class="text-2xl font-bold mb-6">Artists You Might Like</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($popularArtists as $artist)
            <a href="{{ route('artist.show', $artist->id) }}" 
               class="bg-white shadow-lg rounded-lg p-4 text-center block hover:shadow-xl transition transform hover:scale-105">

                <!-- Profile Picture -->
                <img 
                    src="{{ $artist->profile_picture_url }}" 
                    alt="{{ $artist->name }}" 
                    class="w-24 h-24 rounded-full mx-auto mb-4"
                />

                <!-- Artist Name -->
                <h3 class="text-lg font-semibold">{{ $artist->name }}</h3>

                <!-- Number of Paintings -->
                <p class="text-gray-600 mt-2">{{ $artist->products->count() }} Art Pieces</p>

            </a>
        @endforeach
    </div>
</div>



@endsection

@extends('layouts.customer')

@section('content')
<div class="container mx-auto">
    <!-- Artist Profile Section -->
    <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col md:flex-row items-center md:items-start gap-6">
        <!-- Profile Picture -->
        <img 
            src="{{ $artist->profile_picture_url }}" 
            alt="{{ $artist->name }}" 
            class="w-32 h-32 md:w-40 md:h-40 rounded-full shadow-md object-cover"
        >

        <!-- Artist Info -->
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $artist->name }}</h1>
            <p class="text-gray-600 text-lg">{{ $artist->email }}</p>

            @if ($artist->bio)
                <p class="text-gray-700 mt-2">{{ $artist->bio }}</p>
            @else
                <p class="text-gray-400 mt-2 italic">No bio available.</p>
            @endif
        </div>
    </div>

    <!-- Artist's Paintings Section -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Artworks by {{ $artist->name }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($artist->products as $product)
            <div class="bg-white shadow-lg rounded-lg p-4">
                <img src="{{ asset('storage/' . $product->painting_url) }}" 
                     class="w-full h-48 object-cover rounded-lg mb-4"
                     alt="{{ $product->product_name }}">
                <h3 class="text-xl font-semibold">{{ $product->product_name }}</h3>
                <p class="text-gray-700 mt-2">${{ $product->price }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection

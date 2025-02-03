@extends('layouts.customer')

@section('title', 'Edit Product')

@section('content')

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Edit Product</h1>
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="mb-4">
            <label for="product_name" class="block text-gray-700 text-sm font-bold mb-2">
                Product Name
            </label>
            <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">
                Price
            </label>
            <input type="number" name="price" id="price" value="{{ $product->price }}" step="0.01"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                Description
            </label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $product->description }}</textarea>
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label for="painting_url" class="block text-gray-700 text-sm font-bold mb-2">
                Upload New Image (optional)
            </label>
            <input type="file" name="painting_url" id="painting_url"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Current Image Preview -->
        <div class="mb-4">
            <h2 class="text-gray-700">Current Image:</h2>
            <img src="{{ asset('storage/' . $product->painting_url) }}" alt="{{ $product->product_name }}" class="w-32 h-32 object-cover rounded-lg">
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
            Save Changes
        </button>
    </form>
</div>

@endsection
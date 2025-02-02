@extends('layouts.customer')

@section('title', 'Welcome to ArtemVita')

@section('content')


@if(session('success'))
    <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="mt-8 flex justify-center">
    <form action="/submit-painting" method="POST" enctype="multipart/form-data" class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <!-- Painting Name -->
        <div class="mb-4">
            <label for="painting_name" class="block text-gray-700 text-sm font-bold mb-2">
                Painting Name
            </label>
            <input type="text" name="painting_name" id="painting_name" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   placeholder="Enter painting name" required>
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">
                Price
            </label>
            <input type="number" name="price" id="price" step="0.01" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   placeholder="Enter price" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                Description
            </label>
            <textarea name="description" id="description" rows="4" 
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                      placeholder="Enter description" required></textarea>
        </div>

        <!-- Image Upload -->
        <div class="mb-6">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">
                Upload Image
            </label>
            <input type="file" name="image" id="image" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   accept="image/*" required>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Upload
            </button>
        </div>
    </form>
</div>
@endsection
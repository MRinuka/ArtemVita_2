@extends('layouts.customer')

@section('title', 'Checkout')

@section('content')

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold">{{ $product->product_name }}</h2>
        <p class="text-gray-700 text-xl mt-4">Price: ${{ $product->price }}</p>
        
        <form action="{{ route('checkout.process') }}" method="POST" class="mt-6">
            @csrf

            <!-- Hidden Product ID(s) -->
            <input type="hidden" name="product_ids[]" value="{{ $product->id }}">

            <!-- Address Field -->
            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">
                    Shipping Address
                </label>
                <textarea name="address" id="address" rows="4" 
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                          placeholder="Enter your shipping address" required></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
                Place Order
            </button>
        </form>
    </div>
</div>

@endsection

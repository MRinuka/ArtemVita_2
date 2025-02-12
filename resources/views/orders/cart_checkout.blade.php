@extends('layouts.customer')

@section('title', 'Checkout')

@section('content')

<form action="{{ route('checkout.process') }}" method="POST">
    @csrf
    
    @foreach($cartItems as $item)
        <input type="hidden" name="product_ids[]" value="{{ $item->product_id }}">
    @endforeach

    <div class="mb-4">
        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">
            Shipping Address
        </label>
        <textarea name="address" id="address" rows="4" 
                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                  placeholder="Enter your shipping address" required></textarea>
    </div>

    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
        Place Order
    </button>
</form>

@endsection

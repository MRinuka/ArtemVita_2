@extends('layouts.customer')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">Your Order History</h1>

        <!-- Display success message if any -->
        @if(session('success'))
            <div class="mb-4 text-green-500">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <p>You haven't placed any orders yet.</p>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="flex justify-between items-center border-b pb-4 mb-4">
                            <h2 class="text-2xl font-semibold">{{ $order->product_name }}</h2>
                            <span class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-700">Shipping Address</h3>
                                <p class="text-gray-600">{{ $order->address }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-700">Status</h3>
                                <p class="text-gray-600">{{ $order->status }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif
    </div>
@endsection

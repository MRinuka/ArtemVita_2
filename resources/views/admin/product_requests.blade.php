@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Product Requests</h2>

    @if($productRequests->isEmpty())
        <!-- If there are no product requests -->
        <p class="text-center text-lg text-gray-500">No product requests at the moment.</p>
    @else
        <!-- Display product requests -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($productRequests as $productRequest)
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $productRequest->product_name }}</h3>
                        <p class="text-sm text-gray-500">{{ $productRequest->created_at->diffForHumans() }}</p>
                    </div>
                    
                    <p class="text-sm text-gray-700 mb-2">
                        <strong class="font-medium">Price:</strong> ${{ number_format($productRequest->price, 2) }}
                    </p>
                    
                    <p class="text-sm text-gray-700 mb-4 truncate">
                        <strong class="font-medium">Description:</strong> {{ $productRequest->description }}
                    </p>
                    
                    <div class="mb-4">
                        <img src="{{ Storage::url($productRequest->painting_url) }}" alt="Painting Image" class="w-full h-32 object-cover rounded-md shadow-md">
                    </div>
                    
                    <div class="flex justify-between space-x-4">
                        <form action="{{ route('admin.product_requests.accept', $productRequest->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                                Accept
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.product_requests.decline', $productRequest->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition duration-200">
                                Decline
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection

@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Welcome, Admin!</h2>
        

        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Pending Product Requests</h3>

            @if($productRequests->where('status', 'pending')->isEmpty())
                <!-- If there are no pending requests -->
                <p class="text-center text-lg text-gray-500">No pending product requests at the moment.</p>
            @else
                <!-- Display only the first 3 pending product requests -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($productRequests->where('status', 'pending')->take(3) as $productRequest)
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
                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition duration-200">
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

            <!-- View More button -->
            @if($productRequests->where('status', 'pending')->isNotEmpty())
                <div class="text-center mt-6">
                    <a href="{{ route('admin.product_requests') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                        View More Product Requests
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

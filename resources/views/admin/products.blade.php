@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">All Products</h1>

    <!-- Table Container -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full table-auto text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold border-b">Product Name</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold border-b">Price</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold border-b">Description</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr class="hover:bg-gray-50 transition duration-300">
                    <td class="px-6 py-4 border-b">{{ $product->product_name }}</td>
                    <td class="px-6 py-4 border-b">${{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4 border-b">{{ Str::limit($product->description, 50) }}</td>
                    <td class="px-6 py-4 border-b">
                        <a href="{{ route('product.show', $product->id) }}" class="text-blue-500 hover:text-blue-700 transition duration-300">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

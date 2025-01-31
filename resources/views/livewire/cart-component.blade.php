<div class="container mx-auto mt-8">
    @if(!empty($cartItems) && count($cartItems) > 0)
        <div class="bg-white shadow-lg rounded-lg p-8">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Product</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Price</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-4 text-gray-800">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $item['product']['image_url']) }}" 
                                         alt="{{ $item['product']['name'] }}" 
                                         class="w-16 h-16 object-cover rounded-lg mr-4">
                                    <span class="text-sm font-medium">{{ $item['product']['name'] }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-gray-700">${{ number_format($item['price'], 2) }}</td>
                            <td class="px-4 py-4">
                                <!-- Remove Button -->
                                {{-- <form action="{{ route('cart.remove', $item['product']['id']) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to remove this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                        Remove
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-between items-center">
                <p class="text-xl font-semibold">Total: ${{ number_format($totalPrice, 2) }}</p>
                <a href="{{ route('checkout.cart') }}" 
                    class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition">
                    Proceed to Checkout
                </a>

            </div>
        </div>
    @else
        <!-- No Items in Cart -->
        <div class="text-center py-6 text-lg text-gray-700">
            <p>Your cart is currently empty.</p>
            <a href="/products" class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">Continue Shopping</a>
        </div>
    @endif
</div>

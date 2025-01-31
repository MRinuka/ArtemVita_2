<div class="relative w-full sm:w-auto">
    <input   
        type="text"
        wire:model.debounce.500ms="search"
        class="w-full sm:w-80 px-4 py-2 rounded-lg border border-gray-600 bg-white text-black focus:outline-none focus:ring-2 focus:ring-blue-500" 
        placeholder="Search..."
    />



    <!-- Search Results Dropdown -->
    @if(!empty($products))
        <div class="absolute top-12 left-0 w-full bg-white border border-gray-200 shadow-lg mt-2 p-4 rounded-lg z-50">
            @foreach($products as $product)
                <a href="{{ route('product.show', $product->id) }}" class="block bg-white shadow rounded-lg p-2 hover:bg-gray-100 transition">
                    <div class="flex items-center space-x-4">
                        <!-- Image -->
                        <img 
                            src="{{ asset('storage/' . $product->painting_url) }}" 
                            alt="{{ $product->product_name }}" 
                            class="w-12 h-12 object-cover rounded"
                        />
                        <!-- Details -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $product->product_name }}</h2>
                            <p class="text-gray-600">${{ $product->price }}</p>
                        </div>
                    </div>
                </a>
            @endforeach

            @if(count($products) == 0)
                <p class="text-gray-500 text-center">No results found</p>
            @endif
        </div>
    @endif
</div>

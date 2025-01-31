<?php
namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartComponent extends Component
{
    public $cartItems = [];
    public $totalPrice = 0;

    // Load data inside the mount method, as in Code Set 1
    public function mount()
    {
        if (auth()->check()) {
            // Fetch cart items for the authenticated user
            $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

            // Process the cart items
            $this->cartItems = $cartItems->map(function ($cartItem) {
                return [
                    'id' => $cartItem->id,
                    'price' => $cartItem->product->price ?? 0,
                    'product' => [
                        'name' => $cartItem->product->product_name ?? 'Unknown',
                        'image_url' => $cartItem->product->painting_url ?? '',
                    ],
                ];
            })->toArray();

            // Calculate total price
            $this->totalPrice = array_sum(array_column($this->cartItems, 'price'));
        }
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}



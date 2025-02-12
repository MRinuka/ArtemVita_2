<?php
namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartComponent extends Component
{
    public $cartItems = [];
    public $totalPrice = 0;

    
    public function mount()
    {
        if (auth()->check()) {
            
            $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

            
            $this->cartItems = $cartItems->map(function ($cartItem) {
                return [
                    'id' => $cartItem->id,
                    'product_id' => $cartItem->product_id,
                    'price' => $cartItem->product->price ?? 0,
                    'product' => [
                        'name' => $cartItem->product->product_name ?? 'Unknown',
                        'image_url' => $cartItem->product->painting_url ?? '',
                    ],
                ];
            })->toArray();

            
            $this->totalPrice = array_sum(array_column($this->cartItems, 'price'));
        }
    }

    public function removeFromCart($productId)
    {
        if (!Auth::check()) return;

        Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        $this->mount(); 
        session()->flash('success', 'Product removed from cart.');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}



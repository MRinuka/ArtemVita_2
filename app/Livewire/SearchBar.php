<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class SearchBar extends Component
{
    public $search = ''; 
    public $products = []; 

    public function updatedSearch()
    {
        if (!empty($this->search)) {
            $this->products = Product::where('product_name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->get()
                ->take(5); // Limit results to 5
        } else {
            $this->products = [];
        }
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}

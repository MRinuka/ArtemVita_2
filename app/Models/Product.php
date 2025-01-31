<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Optionally, you can define the table name if it's different from the default (products)
    protected $table = 'products';
    
    // Define the fillable fields to prevent mass-assignment vulnerabilities
    protected $fillable = [
        'product_name',
        'price',
        'description',
        'painting_url',
    ];

    // Define the relationship with the Order model
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // In Product.php model
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}


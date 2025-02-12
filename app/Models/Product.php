<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    
    protected $table = 'products';
    
    
    protected $fillable = [
        'product_name',
        'price',
        'description',
        'painting_url',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}


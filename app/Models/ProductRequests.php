<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequests extends Model
{
    use HasFactory;

    
    protected $table = 'product_requests';

    
    protected $fillable = [
        'product_name',
        'price',
        'description',
        'painting_url',
        'seller_id',
        'status',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}

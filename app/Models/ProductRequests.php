<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRequests extends Model
{
    use HasFactory;

    // Define the table name if it's different from the plural form of the model name
    protected $table = 'product_requests';

    // The attributes that are mass assignable
    protected $fillable = [
        'product_name',
        'price',
        'description',
        'painting_url',
        'seller_id',
        'status',
    ];

    // Optionally, if you want to define relationships, for example, to the User (Seller):
    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // You can also define a relationship to Product if you need
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name', // Store product name before product deletion
        'price',        // Store price before product deletion
        'address',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault([
            'product_name' => 'Deleted Product',
            'price' => 0,
        ]);
    }

}

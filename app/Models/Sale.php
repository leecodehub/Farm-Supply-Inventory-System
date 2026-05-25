<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'category', 'qty', 'price', 'total'];

    // Allows each row in your sales ledger to know its parent item info
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
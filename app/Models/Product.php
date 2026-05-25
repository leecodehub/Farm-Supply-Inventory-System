<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // These are the columns we allow our forms to save to the database
    protected $fillable = [
        'sku', 
        'image',
        'name',
        'category', 
        'stock', 
        'max_stock', 
        'price', 
        'alert_level', 
        'status'
    ];
}
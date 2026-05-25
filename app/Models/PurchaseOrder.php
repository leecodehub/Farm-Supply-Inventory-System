<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_number', 
        'supplier', 
        'total_amount', 
        'status', 
        'expected_delivery'
    ];

    // A Purchase Order can have many line items (New!)
    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}
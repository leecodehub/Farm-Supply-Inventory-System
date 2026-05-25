<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalTransaction extends Model
{
    use HasFactory;

    // Allow data to be saved here
    protected $fillable = [
        'rental_id',
        'customer_id',
        'start_date',
        'expected_return_date',
        'actual_return_date',
        'status',
        'damage_fee',
        'total_amount_paid',
        'return_notes',
    ];

    // Link back to the specific Asset
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    // Link back to the specific Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
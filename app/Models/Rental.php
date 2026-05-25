<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // These are the fields we are allowed to fill when creating/updating an asset
    protected $fillable = [
        'name',
        'sn',
        'category',
        'daily_rate',
        'status',
        'image',
    ];

    // Link to tracking history (Notice how it is INSIDE the class now)
    public function transactions()
    {
        return $this->hasMany(RentalTransaction::class);
    }
}
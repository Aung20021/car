<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'buyer_id',
        'owner_id',
        'amount',
        'status',
    ];

    // Relations
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id'); // 'car_id' is the foreign key in the transactions table
    }


    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function transaction()
{
    return $this->hasOne(\App\Models\Transaction::class);
}

}

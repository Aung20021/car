<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'make',
        'model',
        'year',
        'mileage',
        'fuel_type',
        'transmission',
        'engine_size',
        'engine_power',
        'body_type',
        'vin',
        'insurance_status',
        'warranty_status',
        'tire_condition',
        'mechanical_health',
        'price',
        'seller_name',
        'location',
        'contact_information',
        'photos',
        'video_walkaround',
        'test_drive_availability',
        'test_drive_start', // Added test drive start date
        'test_drive_end',   // Added test drive end date
        'registration_details',
        'user_id',
        'buyer_id',  // Add this field
    'is_sold',   // Add this field
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'photos' => 'array',
        'price' => 'decimal:2',
        'created_at' => 'datetime', // Optional, explicitly casting timestamps
        'updated_at' => 'datetime', // Optional, explicitly casting timestamps
        'test_drive_start' => 'datetime', // Ensure the test drive start is a datetime
        'test_drive_end' => 'datetime',   // Ensure the test drive end is a datetime
    ];

    /**
     * Relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function testDrives()
{
    return $this->hasMany(TestDrive::class);
}

public function owner()
{
    return $this->belongsTo(User::class, 'owner_id');
}

public function bids()
{
    return $this->hasMany(Bid::class);
}


public function transaction()
{
    return $this->hasOne(Transaction::class, 'car_id'); // 'car_id' is the foreign key in the transactions table
}

}

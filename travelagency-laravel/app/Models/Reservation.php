<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    security: 'is_granted("PUBLIC_ACCESS")'
)]
class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'resource_id',
        'totalPrice',
        'status',
        'startTime',
        'endTime',
    ];

    protected $casts = [
        'totalPrice' => 'double',
        'startTime' => 'datetime',
        'endTime' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resource()
    {
        return $this->belongsTo(TravelResource::class, 'resource_id');
    }
}

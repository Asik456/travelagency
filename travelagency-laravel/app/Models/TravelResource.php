<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    security: 'is_granted("PUBLIC_ACCESS")'
)]
class TravelResource extends Model
{
    protected $table = 'resources';

    protected $fillable = [
        'name',
        'description',
        'location',
        'region',
        'pricePerNight',
        'imageUrl',
        'averageRating',
        'totalReviews',
    ];

    protected $casts = [
        'pricePerNight' => 'double',
        'averageRating' => 'double',
        'totalReviews' => 'integer',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'resource_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'resource_id');
    }
}

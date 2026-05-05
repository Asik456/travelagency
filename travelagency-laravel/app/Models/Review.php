<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    security: 'is_granted("PUBLIC_ACCESS")'
)]
class Review extends Model
{
    protected $fillable = [
        'user_id',
        'resource_id',
        'rating',
        'comment',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resource()
    {
        return $this->belongsTo(TravelResource::class, 'resource_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

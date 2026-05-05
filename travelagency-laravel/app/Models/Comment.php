<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    security: 'is_granted("PUBLIC_ACCESS")'
)]
class Comment extends Model
{
    protected $fillable = [
        'review_id',
        'text',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}

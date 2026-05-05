<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource(
    security: 'is_granted("PUBLIC_ACCESS")'
)]
class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'isRead',
        'type',
    ];

    protected $casts = [
        'isRead' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

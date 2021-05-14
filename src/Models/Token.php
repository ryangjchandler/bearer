<?php

namespace RyanChandler\Bearer\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'bearer_tokens';

    protected $fillable = [
        'token', 'domains', 'expires_at',
    ];

    protected $casts = [
        'domains' => AsArrayObject::class,
        'expires_at' => 'datetime',
    ];

    protected $appends = [
        'expired',
    ];

    public function getExpiredAttribute()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function setExpiredAttribute(bool $expired)
    {
        $this->expires_at = $expired ? now() : null;
    }
}

<?php

namespace RyanChandler\Bearer\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = [
        'token', 'domains', 'expires_at',
    ];

    protected $casts = [
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

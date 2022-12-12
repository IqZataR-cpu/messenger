<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BlockedUser extends Pivot
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function initiator()
    {
        return $this->belongsTo(User::class,'initiator_id');
    }

    public function blockedUser()
    {
        return $this->belongsTo(User::class, 'blocked_user_id');
    }
}

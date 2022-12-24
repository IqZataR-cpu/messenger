<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    const MINIMUM_USER_COUNT_FOR_GROUP_CHAT = 3;
    const MESSAGES_LIMIT = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function latestMessages()
    {
        return $this->messages()
            ->latest()
            ->with('attachments', 'user.avatar', 'statuses')
            ->take(self::MESSAGES_LIMIT);
    }

    public function getLastMessageAttribute()
    {
        return $this->latestMessages->first();
    }

    public function avatar()
    {
        return $this->morphOne(Attachment::class, 'imaginable');
    }

    public function isGroup()
    {
        return $this->users->count() >= self::MINIMUM_USER_COUNT_FOR_GROUP_CHAT;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
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

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statuses()
    {
        return $this->belongsToMany(MessageStatus::class, 'message_status')
            ->latest();
    }

    public function currentStatus()
    {
        return $this->statuses->first();
    }

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'imaginable');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'imaginable');
    }

    public function isEdited()
    {
        return $this->updated_at > $this->created_at;
    }

    public function isFavoriteMessage()
    {
        return FavoriteMessage::where('message_id', $this->id)->exists();
    }
}

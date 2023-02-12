<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'login',
        'password',
        'phone',
        'description'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function blockedUsers()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'initiator_id', 'blocked_user_id', 'id', 'id', 'blockedBy');
    }

    public function blockedBy()
    {
        return $this->belongsToMany(User::class, 'blocked_users', 'blocked_user_id', 'initiator_id', 'id', 'id', 'blockedUsers');
    }

    public function avatar()
    {
        return $this->morphOne(Attachment::class, 'imaginable');
    }

    public function contacts()
    {
        return $this->belongsToMany(User::class, 'contacts', 'user_id', 'contact_id', 'id', 'id', 'contactsBy');
    }

    public function contactsBy()
    {
        return $this->belongsToMany(User::class, 'contacts', 'contact_id', 'user_id', 'id', 'id', 'contacts');
    }

    public function lastSeen()
    {
        return '';
    }
}

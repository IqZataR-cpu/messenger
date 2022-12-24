<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageStatus extends Model
{
    use HasFactory;

    public const SENT = 'Отправлено';
    public const RECEIVED = 'Получено';
    public const NOT_READ = 'Не прочитано';
    public const READ = 'Прочитано';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
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

    public static function sent()
    {
        return MessageStatus::where('status', self::SENT)->first();
    }

    public static function read()
    {
        return MessageStatus::where('status', self::READ)->first();
    }

    public static function received()
    {
        return MessageStatus::where('status', self::RECEIVED)->first();
    }

    public static function notRead()
    {
        return MessageStatus::where('status', self::NOT_READ)->first();
    }
}

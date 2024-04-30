<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'notification';
    protected $fillable = [
        'battery',
        'last_update',
        'liquid_height',
        'liquid_temperature',
        'percent',
        'remaining_day',
        "tank_id",
        "type_notification_id",
        'volume'
    ];

    public function tank(): BelongsTo
    {
        return $this->belongsTo(Tank::class, "tank_id");
    }

    public function typeNotification(): BelongsTo
    {
        return $this->belongsTo(TypeNotification::class, "type_notification_id");
    }

    public function viewedNotification(): HasMany
    {
        return $this->hasMany(ViewedNotification::class, 'notification_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlertUser extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'alert_user';
    protected $fillable = [
        'user_id',
        'type_notification_id',
        'service_station_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function typeNotification(): BelongsTo
    {
        return $this->belongsTo(TypeNotification::class, "type_notification_id");
    }

}

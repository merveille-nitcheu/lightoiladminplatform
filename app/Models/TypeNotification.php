<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeNotification extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'type_notification';

    protected $fillable = [
        'wording',
        'code'
    ];

    public function notification(): HasMany
    {
        return $this->hasMany(Notification::class, 'type_notification_id');
    }

    public function AlertUser(): HasMany
    {
        return $this->hasMany(AlertUser::class, 'type_notification_id');
    }
}

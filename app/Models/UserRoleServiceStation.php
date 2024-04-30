<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRoleServiceStation extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'user_role_service_station';

    protected $fillable = [
        "service_station_id",
        "user_role_id"
    ];

    public function serviceStation(): BelongsTo
    {
        return $this->belongsTo(ServiceStation::class, "service_station_id");
    }

    public function userRole(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, "user_role_id");
    }
}

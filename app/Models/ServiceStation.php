<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceStation extends Model
{
    use HasFactory,SoftDeletes;


    protected $table = 'service_station';

    protected $fillable = [
        'city',
        'company_id',
        'gmt',
        'last_update',
        'latitude',
        'longitude',
        'name',
        'status',
        'description',
        'back_image_link'

    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, "company_id");
    }

    public function stationProducts(): HasMany
    {
        return $this->hasMany(StationProduct::class, 'service_station_id');
    }

  /*   public function job(): HasOne
    {
        return $this->hasOne(ServiceStationPackageEntity::class, 'service_station_id');
    } */

    public function remainingNotificationParameter(): HasOne
    {
        return $this->hasOne(RemainingNotificationParameter::class, 'service_station_id');
    }

    public function userRoleServiceStation(): HasMany
    {
        return $this->hasMany(UserRoleServiceStation::class, 'service_station_id');
    }

    public function quartWorking(): HasMany
    {
        return $this->hasMany(QuartWorking::class, 'service_station_id');
    }


}

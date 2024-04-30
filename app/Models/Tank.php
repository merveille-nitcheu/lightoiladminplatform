<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tank extends Model
{
    use HasFactory,SoftDeletes;



    protected $table = 'tank';
    protected $fillable = [
        'abacus',
        'diameter',
        'file_path',
        'last_update',
        'liquid_type',
        'man_hole_height',
        'sensor_depth',
        'sensor_reference',
        "station_product_id",
        "jauge_id",
        'time_out',
        'pub_reference',
        'level_active_depotage'

    ];

    public function stationProduct(): BelongsTo
    {
        return $this->belongsTo(StationProduct::class, "station_product_id");
    }

    public function record(): HasMany
    {
        return $this->hasMany(Record::class, 'tank_id');
    }

    public function depotage(): HasMany
    {
        return $this->hasMany(Depotage::class, 'tank_id');
    }

    public function notification(): HasMany
    {
        return $this->hasMany(Notification::class, 'tank_id');
    }

    public function correctionData(): HasOne
    {
        return $this->hasOne(Correction_datas::class, 'tank_id');
    }

    public function jauge(): BelongsTo
    {
        return $this->belongsTo(Jauge::class, "jauge_id");
    }
}

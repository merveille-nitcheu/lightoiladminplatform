<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Record extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'record';


    protected $fillable = [
        'battery_level',
        'density',
        'depotage',
        'env_temperature',
        'last_update',
        'level',
        'liquid_height',
        'liquid_temperature',
        'sensor_reference',
        "tank_id",
        'total_volume',
        'volume',
        'volume_at_fift'
    ];

    public function tank(): BelongsTo
    {
        return $this->belongsTo(Tank::class, "tank_id");
    }
}

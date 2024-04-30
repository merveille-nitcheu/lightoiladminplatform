<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class probe_sensors extends Model
{

    use SoftDeletes,HasFactory;
    protected $table = 'probe_sensors';
    protected $fillable = [
        'sensor_ref',
        'density_up',
        "density_down",
        "temperature_up",
        "temperature_down",
        "level_up",
        "level_down",
        "pressure_up",
        "pressure_down",
        "hourkit"
    ];
}

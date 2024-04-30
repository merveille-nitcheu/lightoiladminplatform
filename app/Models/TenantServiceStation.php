<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TenantServiceStation extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'stations';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function station_sensor() {
        return $this->hasMany(StationSensor::class, 'station_id');
    }
}

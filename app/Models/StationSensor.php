<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StationSensor extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'station_sensor';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function station() {
        return $this->belongsTo(ServiceStation::class, 'station_id');
    }
}

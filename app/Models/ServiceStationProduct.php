<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceStationProduct extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'station_product';
    protected $guarded = [''];

    public function tanks() {
        return $this->hasMany(Tank::class, 'station_product_id');
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function serviceStation() {
        return $this->belongsTo(ServiceStation::class);
    }
}

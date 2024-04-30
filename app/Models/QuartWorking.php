<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuartWorking extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'quart_working';
    protected $fillable = [
        'time_start',
        'time_close',
        "service_station_id"
    ];

    public function serviceStation(): BelongsTo
    {
        return $this->belongsTo(ServiceStation::class, "service_station_id");
    }
}

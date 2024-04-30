<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Correction_datas extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'correction_data';
    protected $fillable = [
        "data_level",
        "data_temp",
        "data_pressure",
        "tank_id"
    ];

    public function tank(): BelongsTo
    {
        return $this->belongsTo(Tank::class, "tank_id");
    }
}

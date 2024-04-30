<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depotage extends Model
{
    use SoftDeletes, HasFactory;


    protected $table = 'depotage';

    protected $fillable = [
        'end_at',
        'end_height',
        'end_liquid_temperature',
        'end_volume',
        'start_height',
        'start_liquid_temperature',
        'start_volume',
        'status',
        'taked_at',
        "tank_id"
    ];

    public function tank(): BelongsTo
    {
        return $this->belongsTo(Tank::class, "tank_id");
    }
}

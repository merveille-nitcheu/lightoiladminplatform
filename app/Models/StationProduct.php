<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StationProduct extends Model
{
    use HasFactory;

    protected $table = 'station_product';
    protected $fillable = [
        'pistolets',
        "product_id",
        "service_station_id",
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id");
    }

    public function serviceStation(): BelongsTo
    {
        return $this->belongsTo(ServiceStation::class, "service_station_id");
    }

    public function tanks(): HasMany
    {
        return $this->hasMany(Tank::class, 'station_product_id');
    }

}

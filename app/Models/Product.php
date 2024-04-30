<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'product';
    protected $fillable = [
        'code',
        'name',
        'price'
    ];

    public function stationProducts(): HasMany
    {
        return $this->hasMany(StationProduct::class, 'product_id');
    }

}

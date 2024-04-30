<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jauge extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'jauges';
    protected $fillable = [
        'name',
        'code',
        'price',

    ];

    public function tanks(): HasMany
    {
        return $this->hasMany(Tank::class);
    }

}

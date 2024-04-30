<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use SoftDeletes,HasFactory;


    protected $table = 'role';

    protected $fillable = [
        'code',
        'display_name'
    ];

    public function userRole(): HasMany
    {
        return $this->hasMany(UserRole::class, 'role_id');
    }
}

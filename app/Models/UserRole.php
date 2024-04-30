<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRole extends Model
{
    use SoftDeletes,HasFactory;


    protected $table = 'user_role';

    protected $fillable = [
        "company_id",
        "role_id",
        "user_id"
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(company::class, "company_id");
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, "role_id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function userRoleServiceStation(): HasMany
    {
        return $this->hasMany(UserRoleServiceStation::class, 'user_role_id');
    }


}

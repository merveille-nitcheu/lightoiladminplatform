<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use  SoftDeletes,HasFactory, Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address',
        'path_image',
        'email',
        'first_name',
        'last_name',
        'last_update',
        'phone',
        'status',
        'password',
        'is_first_con',
        'token'
    ];

    public function userRole(): HasMany
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    public function viewedNotification(): HasMany
    {
        return $this->hasMany(ViewedNotification::class, 'user_id');
    }

    public function AlertUser(): HasMany
    {
        return $this->hasMany(AlertUser::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}

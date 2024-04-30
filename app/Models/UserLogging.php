<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLogging extends Model
{
    use SoftDeletes,HasFactory;

    protected  $fillable = [
        'token',
        'user_id',
        'expiry_date'
    ];
}

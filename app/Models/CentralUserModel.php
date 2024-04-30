<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CentralUserModel extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'user';
    protected $guarded = [''];
}

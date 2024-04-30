<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleCentralDB extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'role';
    protected $guarded = [''];
    protected $primaryKey = 'id';
    public $timestamps = false;
}

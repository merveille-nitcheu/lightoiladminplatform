<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RawData extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'raw_datas';
    protected $guarded = ['id'];
}

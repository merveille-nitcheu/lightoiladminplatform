<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LighoilConfig extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'lighoil_configs';
    protected $guarded = ['id'];
}

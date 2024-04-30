<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TenantBestDailyStation extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'daily_best_service_stations';
    protected $guarded = ['id'];
}

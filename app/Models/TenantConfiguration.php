<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TenantConfiguration extends Model
{
    use SoftDeletes,HasFactory;
    protected $table = 'configurations';
    protected $fillable = [
        'company_logo',
        'colors',
        'financial_year',
        'financial_year_start',
        'custom_configs'
    ];

    protected $cast = [
        'custom_configs' => 'array'
    ];
}

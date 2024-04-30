<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancialYear extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'financial_years';
    protected $fillable = [
        'start_date',
        'expected_end_date',
        'company_id',
    ];
}


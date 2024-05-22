<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use  SoftDeletes,HasFactory;

    protected $table = 'company';
    protected $fillable = [
        'address',
        'last_update',
        'name',
        'phone',
        'email',
        'website',
        'logo'
    ];

    public function serviceStations(): HasMany
    {
        return $this->hasMany(ServiceStation::class, 'company_id');
    }

    public function financialYear(): HasOne
    {
        return $this->hasOne(FinancialYear::class, 'company_id');
    }
}

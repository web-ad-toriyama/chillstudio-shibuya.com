<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company_information';

    protected $fillable = [
        'name',
        'tel',
        'zip_code',
        'address',
        'biz_hours',
        'closed',
        'station_1',
        'station_2',
        'parking',
        'line',
        'twitter',
        'instagram',
        'president',
        'established',
        'capital',
        'business',
        'employees',
        'client'
    ];
}

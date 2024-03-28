<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name_en',
        'country_name_ar',
        'country_iso_code_en',
        'country_iso_code_ar',
        'country_slug',
        'sort_order',
        'status'
    ];

}

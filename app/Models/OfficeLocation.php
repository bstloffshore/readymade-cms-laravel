<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeLocation extends Model
{
    use HasFactory;
    protected $fillable=[
        'address_en',
        'address_ar',
        'address_icon',
        'email',
        'email_icon',
        'tel_number',
        'fax_number',
        'phone',
        'phone_icon',
        'map_link',
        'created_on',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}

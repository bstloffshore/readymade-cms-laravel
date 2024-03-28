<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name_en',
        'site_name_ar',
        'site_url',
        'contact_number',
        'telephone_number',
        'email',
        'login_email',
        'contactus_email',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',
        'company_address_en',
        'company_address_ar',
        'disable',
        'whats_app_number',
        'header_logo',
        'footer_logo',
    ];
}

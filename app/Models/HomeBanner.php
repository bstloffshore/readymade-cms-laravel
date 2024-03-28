<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    use HasFactory;
    protected $fillable=[
        'menu_id',
        'menu_slug',
        'title_en',
        'title_ar',
        'package_id',
        'url_link',
        'banner_title_slug',
        'image_big_screen',
        'image_medium_screen',
        'image_small_screen',
        'sort_order',
        'status',
        'created_on',

    ];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}

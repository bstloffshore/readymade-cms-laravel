<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $fillable=[
        'menus_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'image',
        'image_alt',
        'status',
        'canonical_url',
        'og_title',
        'og_url',
        'og_image',
        'og_type',
        'og_locale',
        'og_description',
        'robots',
    ];
    public function menu()
    {
        return $this->belongsTo(Menu::class,'menus_id');
    }
}

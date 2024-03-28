<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'menu_name_en',
        'menu_name_ar',
        'slug',
        'link',
        'image',
        'image_path',
        'short_description_en',
        'short_description_ar',
        'display_in_nav_bar',
        'display_in_seo',
        'display_in_footer',
        'sort_order',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class,'id');
    }
    public function homeBanners()
    {
        return $this->hasMany(HomeBanner::class,'id');
    }
    public function generalSections()
    {
        return $this->hasMany(GeneralSection::class,'id');
    }
}

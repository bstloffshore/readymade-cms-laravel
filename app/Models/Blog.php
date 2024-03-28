<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'title_en',
        'title_ar',
        'menu_id',
        'menu_slug',
        'blog_title_slug',
        'image',
        'web_image',
        'image_title',
        'image_alt',
        'short_description_en',
        'short_description_ar',
        'description_en',
        'description_ar',
        'block_quote_en',
        'block_quote_ar',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'canonical_url',
        'sort_order',
        'status',
        'is_popular_blog',
        'is_featured',
        'post_date',
        'created_on'

    ];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Gallery extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'title_en',
        'title_ar',
        'image',
        'iamge_title_tag',
        'image_alt_text',
        'sort_order',
        'status',
        'image_thumb_path',
        'image_medium_path',
        'image_large_path',
    ];



}

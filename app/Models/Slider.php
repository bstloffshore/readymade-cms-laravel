<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable=['first_title_en','first_title_ar','second_title_en','second_title_ar','third_title_en','third_title_ar','image','image_alt','sort_order','status'];
}

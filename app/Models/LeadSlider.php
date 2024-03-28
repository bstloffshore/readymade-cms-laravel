<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSlider extends Model
{
    use HasFactory;
    protected $fillable=['image','image_title','image_alt','sort_order','status'];

}

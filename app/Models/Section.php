<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'general_sections_id',
        'section_title_en',
        'section_title_ar',
        'icon',
        'icon_file',
        'status',
        'sort_order',
        'description_en',
        'description_ar',
        'created_on'
    ];

    public function generalSections(){
        return $this->belongsTo(GeneralSection::class,'general_sections_id');
    }
}

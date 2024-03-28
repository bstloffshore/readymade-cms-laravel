<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'menu_id',
        'menu_slug',
        'category_title_en',
        'category_title_ar',
        'highlight_en',
        'highlight_ar',
        'description_en',
        'description_ar',
        'sort_order',
        'allow_edit',
        'status',
        'icon_file',
        'image',
        'image_alt',
        'created_on'
    ];


    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(GeneralSection::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(GeneralSection::class, 'parent_id');
    }
    public function sections(){
        return $this->hasMany(Section::class,'general_sections_id');
    }

    public function selectSections()
    {
        return $this->hasMany(Section::class, 'general_sections_id', 'id')
        ->select('id', 'general_sections_id', 'section_title_en','section_title_ar','description_en','description_ar','icon','icon_file','sort_order');
    }








}

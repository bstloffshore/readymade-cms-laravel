<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagePermissionName extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'module_settings_id',
        'permission_name',
        'permission_slug',
        'module_name',
        'module_slug',
        'status',
        'created_on'
    ];
    public function moduleSetting()
    {
        return $this->belongsTo(ModuleSetting::class,'id');
    }
}

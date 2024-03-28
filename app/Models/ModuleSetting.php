<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class ModuleSetting extends Model
{
    use HasFactory;
    protected $fillable = ['module_name','module_slug','created_on'];

    public function permissions()
    {
        return $this->hasMany(Permission::class,'module_settings_id');
    }

}

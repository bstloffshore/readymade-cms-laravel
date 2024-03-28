<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\Contracts\MenuRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MenuRepository implements MenuRepositoryInterface
{

    public function validateMenuData(array $data)
    {
        return validator($data, [
            'menu_name_en' => 'required',
            'sort_order' => 'required',
            'status' => 'required',
            'slug' => [
                'required',
                'min:3',
                'max:200',
                function ($attribute, $value, $fail) use ($data) {
                    $categoryId = $data['parent_id'];
                    $query = Menu::where('slug', $value)->where('parent_id', $categoryId);
                    if ($query->exists()) {
                        $fail("The $attribute has already been taken within the same menu.");
                    }
                },
            ],
        ])->validate();
    }

    public function validateMenuUpdateData(array $data)
    {
        return validator($data, [
            'menu_name_en' => 'required',
            'sort_order' => 'required'
        ])->validate();
    }

    public function all()
    {
        return Menu::with('parent')->get();
    }

    public function find($id)
    {
        return Menu::with('parent')->find($id);
    }

    public function create(array $data)
    {
        return Menu::create($data);
    }

    public function update($id, array $data)
    {
        $menu = Menu::findOrFail($id);
        $menu->update($data);

        return $menu;
    }

    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return $menu;
    }
}

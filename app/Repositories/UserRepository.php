<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{

    public function validateUserStoreData(array $data)
    {
        return validator($data, [
            'name' => 'required',
            'phone' => 'required|phone|unique:users,email',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required',
            'status' => 'required',
        ])->validate();
    }

    public function validateUserUpdateData(array $data,$id)
    {
        return validator($data, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                'unique:users,email,'.$id,
                'regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
            ],
            'phone' => [
                'required',
                'digits:10',
                'unique:users,phone,'.$id,
                'regex:/^(\+?\d{1,3}[-\.\s]?)?\(?\d{3}\)?[-\.\s]?\d{3}[-\.\s]?\d{4}$/'
            ],
        ])->validate();
    }

    public function all()
    {
        return User::with('parent')->get();
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($data['roles']);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $user;
    }
}

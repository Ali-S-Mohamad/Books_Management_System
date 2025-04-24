<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function list()
    {
        return User::paginate(5);
    }
    public function store(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
    public function find(int $id): User
    {
        return User::findOrFail($id);
    }
    public function update(int $id, array $data): User
    {
        $user = $this->find($id);
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return $user;
    }
    public function delete(int $id): bool
    {
        return (bool) User::destroy($id);
    }
}

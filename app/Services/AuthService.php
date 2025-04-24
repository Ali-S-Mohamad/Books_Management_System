<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
    public function login(string $email, string $password): User
    {
        $user = User::where('email', $email)->firstOrFail();
        if (!Hash::check($password, $user->password)) {
            throw new \Exception('Invalid credentials');
        }
        return $user;
    }
}

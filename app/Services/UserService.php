<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 *
 * @package UserService
 *
 * @method User createUser(array $credentials)
 * @method User|bool updateUser(int $id, array $credentials)
 * @method bool changePassword(int $id, string $password)
 */
class UserService
{
    public function createUser(array $credentials): User
    {
        return User::create($credentials);
    }

    public function updateUser(int $id, array $credentials): User|bool
    {
        $user = User::find($id);

        if($user) {
            return $user->update($credentials);
        }

        return false;
    }

    public function changePassword(int $id, string $password): bool
    {
        $user = User::find($id);

        if($user) {
            $user->password = Hash::make($password);
            $user->save();

            return true;
        }

        return false;
    }
}

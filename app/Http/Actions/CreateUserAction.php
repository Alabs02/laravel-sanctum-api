<?php

namespace App\Http\Actions;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\DTO\CreateUserRequestData;

class CreateUserAction
{
    public function execute(CreateUserRequestData $createUserRequestData): User
    {
        return User::create([
            'name' => $createUserRequestData->name,
            'email' => $createUserRequestData->email,
            'password' => $createUserRequestData->password,
        ]);

    }
}

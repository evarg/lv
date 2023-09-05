<?php

namespace Tests\Helpers\Traits;

use App\Models\User;

trait CreateUser
{
    protected string $userEmail = 'user123@roslina.com.pl';
    protected string $userPassword = '1qazxsw2';

    protected function createUser(bool $verified = false): User
    {
        $userData = [
            'email' => $this->userEmail,
            'password' => $this->userPassword,
        ];

        $user = User::factory()->create($userData);

        if ($verified)
            $user->markEmailAsVerified();

        return $user;
    }
}

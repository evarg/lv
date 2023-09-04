<?php

namespace Tests\Helpers;

trait PersonalAccessToken
{
    protected function createPersonalClient()
    {
        $this->artisan(
            'passport:client',
            ['--name' => config('app.name'), '--personal' => null]
        );
    }
}

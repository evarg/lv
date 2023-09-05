<?php

namespace Tests\Helpers\Traits;

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

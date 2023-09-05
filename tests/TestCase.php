<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Helpers\Traits\CreateUser;
use Tests\Helpers\Traits\PersonalAccessToken;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use PersonalAccessToken;
    use CreateUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->createPersonalClient();
    }

}

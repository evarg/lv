<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Helpers\PersonalAccessToken;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use PersonalAccessToken;

    public function setUp(): void
    {
        parent::setUp();
        $this->createPersonalClient();
    }

}

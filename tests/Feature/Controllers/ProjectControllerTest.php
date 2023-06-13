<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function ttest_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Controllers;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Response;

class CountryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store_valid(): void
    {
        $countryFull = Country::factory()->make();

        $response = $this->postJson('/api/countries', $countryFull->toArray());
        $response->assertStatus(200);

        $countryFail = $countryFull;
        $countryFail->name = '';
        $response = $this->postJson('/api/countries', $countryFail->toArray());
        $response->assertStatus(422);
    }

    public function test_store_invalid(): void
    {
        $country = [];
        $response = $this->postJson('/api/countries', $country);
        $response->assertJsonStructure(
            [
                'message',
                'errors' => [
                    'name',
                    'code_alpha_2',
                    'code_alpha_3',
                    'code_numeric',
                ]
            ]
        );
    }
}

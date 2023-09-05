<?php

namespace Tests\Feature\Controllers;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Response;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLogin_withoutData(): void
    {
        $response = $this->postJson('/api/auth');
        $response->assertStatus(422);
    }

    public function testLogin_withoutPassword(): void
    {
        $this->createUser();
        $credencials = [
            'email' => $this->userEmail,
        ];
        $response = $this->postJson('/api/auth', $credencials);
        $response->assertStatus(422);
    }

    public function testLogin_withoutEmail(): void
    {
        $this->createUser();
        $credencials = [
            'password' => $this->userPassword,
        ];
        $response = $this->postJson('/api/auth', $credencials);
        $response->assertStatus(422);
    }

    public function testLogin_withInvalidPassword(): void
    {
        $this->createUser();
        $credencials = [
            'email' => $this->userEmail,
            'password' => '1234asdfasdcx',
        ];
        $response = $this->postJson('/api/auth', $credencials);
        $response->assertStatus(401);
    }

    public function testLogin_withValidCredencialsAndEmailIsNotVerified(): void
    {
        $this->createUser();
        $credencials = [
            'email' => $this->userEmail,
            'password' => $this->userPassword,
        ];
        $response = $this->postJson('/api/auth', $credencials);
        $response->assertStatus(403);
    }

    public function testLogin_withValidCredencialsAndEmailIsVerified(): void
    {
        $this->createUser(true);
        $credencials = [
            'email' => $this->userEmail,
            'password' => $this->userPassword,
        ];
        $response = $this->postJson('/api/auth', $credencials);
        $response->assertStatus(200);
    }
}

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
        // Arrange
        //   1. utworzenie użytkownika
        $userEmail = 'useremail@example.com';
        $userPassword = 'testpassword';

        $user = User::factory()->create(
            [
                'email' => $userEmail,
                'password' => $userPassword,
            ]
        );

        // Act
        $response = $this->postJson('/api/auth');

        // Asset
        $response->assertStatus(422);
    }

    public function testLogin_withoutPassword(): void
    {
        // Arrange
        //   1. utworzenie użytkownika
        $userEmail = 'useremail@example.com';
        $userPassword = 'testpassword';

        $user = User::factory()->create(
            [
                'email' => $userEmail,
                'password' => $userPassword,
            ]
        );
        $credencials = [
            'email' => $userEmail,
        ];

        // Act
        $response = $this->postJson('/api/auth', $credencials);

        // Asset
        $response->assertStatus(422);
    }

    public function testLogin_withoutEmail(): void
    {
        // Arrange
        //   1. utworzenie użytkownika
        $userEmail = 'useremail@example.com';
        $userPassword = 'testpassword';

        $user = User::factory()->create(
            [
                'email' => $userEmail,
                'password' => $userPassword,
            ]
        );
        $credencials = [
            'password' => $userPassword,
        ];

        // Act
        $response = $this->postJson('/api/auth', $credencials);

        // Asset
        $response->assertStatus(422);
    }

    public function testLogin_withInvalidPassword(): void
    {
        // Arrange
        $userEmail = 'useremail@example.com';
        $userPassword = 'testpassword';

        $user = User::factory()->create(
            [
                'email' => $userEmail,
                'password' => $userPassword,
            ]
        );
        $credencials = [
            'email' => $userEmail,
            'password' => '1234asdfasdcx',
        ];

        // Act
        $response = $this->postJson('/api/auth', $credencials);

        // Asset
        $response->assertStatus(401);
    }

    public function testLogin_withValidCredencials(): void
    {
        // Arrange

        $userEmail = 'useremail@example.com';
        $userPassword = 'testpassword';

        $user = User::factory()->create(
            [
                'email' => $userEmail,
                'password' => $userPassword,
            ]
        );
        $credencials = [
            'email' => $userEmail,
            'password' => $userPassword,
        ];

        // Act
        $response = $this->postJson('/api/auth', $credencials);

        // Asset
        $response->assertStatus(200);
    }
}

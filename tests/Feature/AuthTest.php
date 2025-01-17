<?php

namespace Tests\Feature;

use App\Domains\Personal\Models\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private CONST TEST_USER_NAME = 'TestUser';
    private CONST TEST_USER_EMAIL = 'TestUser@testEmail.com';
    private CONST TEST_USER_PASSWORD = 'password123';
    private CONST TEST_USER_PHONE = '+7933311111121';
    private CONST TEST_USER_COUNTRY = 'Germany';
    private CONST TEST_USER_CITY = 'Berlin';

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }


    public function testCanUserLogin()
    {
        $testEmail = self::TEST_USER_EMAIL;
        $testPassword = self::TEST_USER_PASSWORD;

        $testUser = User::first();

        $response = $this->actingAs($testUser)->post('/api/auth/login', [
            'email' => $testEmail,
            'password' => $testPassword,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testCanNewUserRegister()
    {
        $response = $this->post('/api/auth/register', [
            'name' => self::TEST_USER_NAME,
            'email' => self::TEST_USER_EMAIL,
            'phone' => self::TEST_USER_PHONE,
            'country' => self::TEST_USER_COUNTRY,
            'city' => self::TEST_USER_CITY,
            'role_id' => $this->getRandomRoleId(),
            'password' => self::TEST_USER_PASSWORD,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    private function getRandomRoleId():int
    {
        return Role::inRandomOrder()->first()->id;
    }

}

<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private $randomUser;
    private $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testCanUserLogin()
    {
        $createdTestUser = $this->createRandomUser();

        $response = $this->post('/api/auth/login', [
            'email' => $createdTestUser->email,
            'password' => self::TEST_USER_PASSWORD,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testCanUserLogout()
    {
        $testUser = User::first();
        $response = $this->actingAs($testUser)->post('/api/auth/logout/');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUnauthenticatedUserCannotAccessToPrivatePath()
    {
        $response = $this->get('/api/personal/candidate/get-personal-data');
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function testCanNewUserRegister()
    {
        $response = $this->post('/api/auth/register', [
            'name' => self::TEST_USER_NAME,
            'email' => time().'mail@test.com',
            'phone' => self::TEST_USER_PHONE,
            'country' => self::TEST_USER_COUNTRY,
            'city' => self::TEST_USER_CITY,
            'role_id' => $this->getRandomRoleId(),
            'password' => self::TEST_USER_PASSWORD,
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}

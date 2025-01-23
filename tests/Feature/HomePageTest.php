<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testCanGuestAccessToHomepage()
    {
        $response = $this->getJson('/api/homepage/');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Homepage data');

        $response->assertJsonStructure([
            'info' => [
                'cities' => [],
                'job_categories' => [],
                'vacancies' => [],
                'candidates' => [],
                'companies' => [],
            ]]
        );
    }

}

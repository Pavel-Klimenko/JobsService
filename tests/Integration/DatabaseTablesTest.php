<?php

namespace Tests\Integration;

use App\Domains\Vacancies\Models\Vacancies;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTablesTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDatabaseHasMainTables()
    {
        $this->seed();

        $this->assertDatabaseHas('users', ['email' => 'admin@admin.com']);

        $this->assertDatabaseHas('roles', ['name' => 'admin']);
        $this->assertDatabaseHas('roles', ['name' => 'company']);
        $this->assertDatabaseHas('roles', ['name' => 'candidate']);

        $this->assertDatabaseHas('vacancies', []);
        $this->assertDatabaseHas('candidates', []);


        $this->assertDatabaseHas('invitation_statuses', ['code' => 'accepted']);
        $this->assertDatabaseHas('invitation_statuses', ['code' => 'rejected']);
        $this->assertDatabaseHas('invitation_statuses', ['code' => 'no_status']);


        $this->assertDatabaseHas('candidate_levels', ['code' => 'junior']);
        $this->assertDatabaseHas('candidate_levels', ['code' => 'middle']);
        $this->assertDatabaseHas('candidate_levels', ['code' => 'senior']);

        $this->assertDatabaseHas('job_categories', ['name' => 'java']);
        $this->assertDatabaseHas('job_categories', ['name' => 'php']);
        $this->assertDatabaseHas('job_categories', ['name' => 'javascript']);
        $this->assertDatabaseHas('job_categories', ['name' => 'python']);
    }
}

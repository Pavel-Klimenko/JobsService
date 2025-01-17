<?php

namespace Tests\Integration;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseMainTablesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testDatabaseHasUserRoles()
    {
        $this->assertDatabaseHas('roles', ['name' => 'admin']);
        $this->assertDatabaseHas('roles', ['name' => 'company']);
        $this->assertDatabaseHas('roles', ['name' => 'candidate']);
    }

    public function testDatabaseHasUsersTableWithAdmin()
    {
        $this->assertDatabaseHas('users', ['email' => 'admin@admin.com']);
    }

    public function testDatabaseHasVacanciesTable()
    {
        $this->assertDatabaseHas('vacancies', []);
    }

    public function testDatabaseHasCandidatesTable()
    {
        $this->assertDatabaseHas('candidates', []);
    }

    public function testDatabaseHasInvitationStatuses()
    {
        $this->assertDatabaseHas('invitation_statuses', ['code' => 'accepted']);
        $this->assertDatabaseHas('invitation_statuses', ['code' => 'rejected']);
        $this->assertDatabaseHas('invitation_statuses', ['code' => 'no_status']);
    }

    public function testDatabaseHasCandidateLevels()
    {
        $this->assertDatabaseHas('candidate_levels', ['code' => 'junior']);
        $this->assertDatabaseHas('candidate_levels', ['code' => 'middle']);
        $this->assertDatabaseHas('candidate_levels', ['code' => 'senior']);
    }

    public function testDatabaseHasJobMainJobCategories()
    {
        $this->assertDatabaseHas('job_categories', ['name' => 'java']);
        $this->assertDatabaseHas('job_categories', ['name' => 'php']);
        $this->assertDatabaseHas('job_categories', ['name' => 'javascript']);
        $this->assertDatabaseHas('job_categories', ['name' => 'python']);
    }
}

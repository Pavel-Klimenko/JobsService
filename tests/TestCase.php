<?php

namespace Tests;

use App\Domains\Personal\Models\Role;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected CONST TEST_USER_NAME = 'TestUser';
    protected CONST TEST_VACANCY_NAME = 'TestVacancy';
    protected CONST TEST_VACANCY_DESCRIPTION = 'TestVacancyDescription';
    protected CONST TEST_USER_PASSWORD = 'password123';
    protected CONST TEST_USER_PHONE = '+7933311111121';
    protected CONST TEST_USER_COUNTRY = 'Germany';
    protected CONST TEST_USER_CITY = 'Berlin';
    protected CONST TEST_USER_SALARY = 3213;

    protected function getRandomCandidateUser():User
    {
        $candidateRoleId = Role::where('name', 'candidate')->first()->id;
        return User::where('role_id', $candidateRoleId)->first();
    }

    protected function getRandomUser():User
    {
        $companyRoleId = Role::whereIn('name', ['company', 'candidate'])->first()->id;
        return User::where('role_id', $companyRoleId)->first();
    }

    protected function getRandomCompanyUser():User
    {
        $companyRoleId = Role::where('name', 'company')->first()->id;
        return User::where('role_id', $companyRoleId)->first();
    }

    protected function getRandomRoleId():int
    {
        return Role::inRandomOrder()->first()->id;
    }

    protected function createRandomUser():User
    {
        return User::create([
            'name' => self::TEST_USER_NAME,
            'email' => time().'mail@test.com',
            'password' => bcrypt(self::TEST_USER_PASSWORD),
            'role_id' => $this->getRandomRoleId(),
        ]);
    }
}

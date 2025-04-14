<?php

namespace App\Contracts;

interface PersonalDataContract
{
    public function updatePersonalInfo($request): void;
}

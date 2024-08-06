<?php

namespace App\Domains\Candidates\Models;

use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobCategories extends Model
{
    protected $table = 'job_categories';
    const TABLE_NAME = 'job_categories';

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancies::class, 'job_category_id');
    }
}

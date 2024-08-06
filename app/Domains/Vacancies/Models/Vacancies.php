<?php
namespace App\Domains\Vacancies\Models;

use App\Domains\Candidates\Models\JobCategories;
use App\Domains\Personal\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacancies extends Model
{
    protected $guarded = [];
    protected $table = 'vacancies';
    const TABLE_NAME = 'vacancies';

    public function job_category(): belongsTo
    {
        return $this->belongsTo(JobCategories::class);
    }

    public function company(): belongsTo
    {
        return $this->belongsTo(Company::class)->with('user');
    }
}

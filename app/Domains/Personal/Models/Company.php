<?php

namespace App\Domains\Personal\Models;


use App\Domains\Vacancies\Models\Vacancies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\User;

class Company extends Model
{
    protected $guarded = [];
    protected $table = 'companies';
    const TABLE_NAME = 'companies';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancies::class)
            ->with('requestsOfCandidates');
    }

}

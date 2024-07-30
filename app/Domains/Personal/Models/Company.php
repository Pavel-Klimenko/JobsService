<?php

namespace App\Domains\Personal\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

}

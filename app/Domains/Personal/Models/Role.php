<?php

namespace App\Domains\Personal\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    protected $table = 'roles';
    const TABLE_NAME = 'roles';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

}

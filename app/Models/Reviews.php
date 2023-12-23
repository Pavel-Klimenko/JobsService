<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $guarded = [];
    protected $table = 'reviews';
    protected $primaryKey = 'ID';

    public static function getReviewFields() {
        return ['NAME', 'PHOTO' , 'REVIEW', 'ACTIVE'];
    }
}

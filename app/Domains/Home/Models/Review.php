<?php

namespace App\Domains\Home\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];
    protected $table = 'reviews';
    const TABLE_NAME = 'reviews';

    public static function getReviewFields() {
        return ['NAME', 'PHOTO' , 'REVIEW', 'ACTIVE'];
    }
}

<?php

namespace App\Domains\Home\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $guarded = [];
    protected $table = 'reviews';
    const TABLE_NAME = 'reviews';

//    public static function getReviewFields() {
//        return ['NAME', 'PHOTO' , 'REVIEW', 'ACTIVE'];
//    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

}

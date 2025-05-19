<?php
namespace App\Domains\Chat\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use App\User;


class Message extends Model
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'message';
    const TABLE_NAME = 'message';

    protected $fillable = ['user_id', 'message'];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php
namespace App\Domains\Chat\Models;

use App\Domains\Candidates\Models\Candidate;
use App\Domains\Personal\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Chat extends Model
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'chats';
    const TABLE_NAME = 'chats';

    protected $fillable = ['candidate_id', 'company_id'];

    public function company(): belongsTo
    {
        return $this->belongsTo(Company::class)->with('user');
    }

    public function candidate(): belongsTo
    {
        return $this->belongsTo(Candidate::class)->with('user');
    }
}

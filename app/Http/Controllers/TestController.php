<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 02/12/23
 * Time: 22:40
 */

namespace App\Http\Controllers;

use App\Domains\Candidates\Models\Candidate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use Laravel\Sanctum\HasApiTokens;
use Mailgun\Mailgun;

use App\Services\RabbitMQService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Constants;
use App\Services\AuthService;

use App\Domains\Personal\Models\Role;

use App\Domains\Vacancies\Models\Vacancies;
use App\Helper;


class TestController extends Controller
{
    use HasApiTokens, Notifiable;

    public function test()
    {
        echo 222222222;


        $jobCategories = DB::table('job_categories')->get();
        foreach ($jobCategories as $category) {
            $category->QUANTITY_OF_VACANCIES = Helper::countTableRow(Vacancies::class, 'job_category_id', $category->id);
        }

        dump($jobCategories);

    }
}

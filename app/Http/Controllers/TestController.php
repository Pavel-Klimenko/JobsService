<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 02/12/23
 * Time: 22:40
 */

namespace App\Http\Controllers;

use App\Domains\Candidates\Models\Candidates;
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


class TestController extends Controller
{
    use HasApiTokens, Notifiable;

    public function test()
    {
    }
}

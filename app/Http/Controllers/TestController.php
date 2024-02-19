<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 02/12/23
 * Time: 22:40
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use Mailgun\Mailgun;

use App\Services\RabbitMQService;

class TestController extends Controller
{
    public function test()
    {
        //TODO используем бесплатный SMTP

//        $emailTo = 'pavel.klimenko.1989@gmail.com';
//
//        Mail::to($emailTo)->send(new UserNotification());
    }
}

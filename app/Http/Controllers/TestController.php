<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 02/12/23
 * Time: 22:40
 */

namespace App\Http\Controllers;


use App\Models\JobCategories;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use Mailgun\Mailgun;

class TestController extends Controller
{
    public function test()
    {
        //TODO используем бесплатный SMTP
        Mail::to('pavel.klimenko.1989@gmail.com')->send(new UserNotification());
    }
}



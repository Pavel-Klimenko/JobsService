<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BroadcastController extends Controller
{
    public function auth(Request $request)
    {
        if (!Auth::check()) {
            return response('Forbidden', 403);
        }

//        $socketId = $request->input('socket_id');
//        $channelName = $request->input('channel_name');

        // Authenticate the user for the private channel
        $user = Auth::user();
        $auth = $user ? $user->createToken('authToken')->accessToken : null;

        // Return the authentication response
        return response()->json([
            'auth' => $auth,
        ]);
    }
}

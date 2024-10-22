<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat_request;

class ChatRequestController extends Controller
{
    function chatrequest(Request $request, $id)
    {

        $login_user = $request->session()->get('loginUser')->id;

        $save = [
            'from_user_id' => $login_user,
            'to_user_id' => $id,
            'status' => 'Pending'
        ];
        // Chat_request::create($save);
        return back()->with('success','Message Sent!');
    }
}

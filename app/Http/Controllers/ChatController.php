<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;

class ChatController extends Controller
{
    function chatrequest(Request $request, $id)
    {

      $data =   User::where('id',$id)->first();
       return response()->json(['status' => true,'data' => $data]);
    }
    function chat_save(Request $request)
    {

        $loginuser = $request->session()->get('loginUser')->id;
       $this->validate($request,[
            'chat' => 'required'
       ]);
       $save = [
            'from_user_id' => $loginuser,
            'to_user_id' => $request->userid,
            'chat' => $request->chat,
       ];
       Chat::create($save);
       return response()->json(['status'=>true, 'message'=>'Message Send!!!']);
    }
    function chat_show($id)
    {
       $data = Chat::where('to_user_id',$id)->first();
       if($data == null){
            return response()->json(['status'=>false]);
       }else{
           return response()->json(['status' => true, 'data' => $data]);
       }

    }
}

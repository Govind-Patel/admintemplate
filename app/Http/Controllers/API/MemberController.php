<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use validate;

class MemberController extends Controller
{
    function register(Request $request)
    {
        $validate = $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'password' => 'required',
            'phone' => 'required'
        ]);
        // if($validate->fails()){
        //     return response()->json(['error'=>$validate->errors()],401);
        // }
       $save = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "phone" => $request->phone
       ];
       dd($request->all());
       Member::create($save);
    }
}

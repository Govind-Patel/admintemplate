<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function loginform_show()
    {
        return view('admin.users.login');
    }

    function registerform_show()
    {
        $data = Role::get();
        return view('admin.users.register',compact('data'));
    }


    function register_data(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|digits:10',
            'role_id' => 'required'
        ]);
        $save = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role_id' => $request->role_id
        ];
        User::create($save);
        return back()->with('success','your register successfully');
    }

    function login_user(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);
        $data = User::where('email',$request->email)->first();
        if(!empty($data)){
            if(Hash::check($request->password, $data->password)){
                $request->session()->put('loginUser',$data);

                switch ($request->session()->get('loginUser')->role->user_type) {
                    case 'admin':
                        return redirect('admin/dashboard')->with('success','admin login successfully');
                        break;

                    case 'Teachers':
                        return redirect('teachers/dashboard')->with('success','teacher login successfully');
                        break;
                    case 'students':
                        return redirect('students/dashboard')->with('success','student login successfully');
                        break;
                    default:
                        return redirect('admin/login')->with('error','your login failed');
                }
            }else{
                return redirect('admin/login')->with('error','Password Are Wrong.');
            }
        }
           else{
            return redirect('admin/login')->with('error','Email-Address And Password Are Wrong.');
           }
    }

    function logout_user(Request $request)
    {

        // $request->session()->forget('loginUser');
        Session::forget('loginUser');
        return redirect('admin/login')->with('success','logout successfully.');
    }

}

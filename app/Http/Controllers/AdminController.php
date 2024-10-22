<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Chat_request;

class AdminController extends Controller
{
    function dashboard(Request $request)
    {
        $data = User::where('role_id',2)->orWhere('role_id',3)->get();
        // $data1 = Chat_request::where('status','Pending')->with('user')->get();
        // dd($data1);
        return view('admin.users.dashboard',compact('data'));
    }

    function admin_edit($id)
    {
        $data = User::where('id',$id)->first();
        return response()->json(['status' => 200,'admin' => $data]);
    }

    function admin_update(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:10'
        ]);

        $update = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        User::where('id',$request->a_id)->update($update);
        return response()->json(['success' => 'admin updated successfully']);

    }

    function admin_add_teacher(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|digits:10'
        ]);
        $save = [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            'phone' => $request->phone,
            'role_id' => $request->role_id,
        ];
        User::create($save);
        return response()->json(['success' => 'user added successfully']);
    }

    function admin_students_add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|digits:10'
        ]);
        $save = [
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            'phone' => $request->phone,
            'role_id' => $request->role_id,
        ];
        User::create($save);
        return response()->json(['success' => 'user added successfully']);
    }

    function admin_details(Request $request)
    {
        $login_id =  $request->session()->get('loginUser')->role->id;
        $data = User::where('id',$login_id)->first();
        return view('admin.users.admin.admin_details',\compact('data'));
    }

    function admin_teachers_details(Request $request)
    {
        $search = $request->search;
        $data = User::where('role_id',2)->where('name','LIKE','%'.$search.'%')->paginate(2);
        // $data = User::where('role_id',2)->get();
       return view('admin.users.admin.admin_teacher',compact('data'));
    }


    function admin_students_details(Request $request)
    {
        $search = $request->searching;
        $data =User::where('role_id','=',3)->where('name','LIKE','%'.$search.'%')->paginate(3);
        return view('admin.users.admin.admin_students',\compact('data'));
    }

    function admin_teachers_edit($id)
    {
        $data = User::where('id',$id)->first();
        return response()->json(['status' => 200, 'teacher' => $data]);
    }

    function admin_teachers_update(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:10',
            'address' => 'required',
        ]);
        $update = [
            'name' => $request->name,
            'email' =>$request->email,
            'phone' => $request->phone,
            'address' => $request->address,

        ];
        $image = $request->file('image');
        // dd($image);
        if ($image) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $update['image'] = "$profileImage";
        }else{
            unset($request['image']);
        }
        $data =  User::where('id',$request->at_id)->update($update);
        return response()->json(['success' => 'admin teacher updated successfully!!',]);
        // return redirect('admin/teachers/details')->with('success','Admin Updated Teacher Successfully');
    }

    function admin_teachers_delete(Request $request)
    {
        // dd($request->t_id);
        User::where('id',$request->t_id)->delete();
        return response()->json(['success' => 'deleted data successfully!!',]);
    }

    function admin_students_edit($id)
    {
        $data = User::where('id',$id)->first();
        return response()->json(['status'=>200 , 'student' => $data]);
    }

    function admin_students_update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:10',
            'address' => 'required',
        ]);
        $update = [
            'name' =>$request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $image = $request->file('image');
        if ($image) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $update['image'] = "$profileImage";
        }else{
            unset($request['image']);
        }
         User::where('id',$request->as_id)->update($update);
        return response()->json(['success'=>'Admin Updated Students Successfully']);
        // return redirect('admin/students/details')->with('success','Admin Updated Students Successfully');
    }

    function admin_students_delete(Request $request)
    {
         User::where('id',$request->s_id)->delete();
         return response()->json(['success'=>'deleted successfully']);

    }
}

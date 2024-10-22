<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Session;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    function teachers_dashboard()
    {
        return view('admin.users.teachersdashboard');
    }

    function teachers_details(Request $request)
    {
        $login_user_id = $request->session()->get('loginUser')->id;
        $data = User::where('id',$login_user_id)->first();
        return view('admin.users.teachers.teachers_details',compact('data'));
    }

    function teachers_edit($id)
    {

        $data = User::where('id',$id)->first();
        return \response()->json(['success'=>200,'teacher'=>$data]);
    }

    function teachers_update(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|',
            'phone' => 'required|digits:10',
            'address' =>'required',
        ]);
        $update = [
            'name' => $request->name,
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
        User::where('id',$request->t_id)->update($update);
        return \response()->json(['success' => 'update successfully']);
        // return redirect('teachers/details')->with('success','update successfully');
    }

    function teachers_delete(Request $request)
    {

       User::where('id',$request->t_id)->delete();
        return redirect('teachers/details')->with('success','teacher deleted successfully');

    }

    function teachers_students(Request $request)
    {
        $data = User::where('role_id','=',3)->where('name','LIKE','%'.$request->search.'%')->paginate(3);

        // $data = User::where('role_id','=',3)->get();
        return view('admin.users.teachers.students_details',compact('data'));
    }

    function teachers_students_add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10',
            'password' => 'required',
        ]);
        $save = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' =>Hash::make($request->password),
            'role_id' => $request->role_id,
        ];
        User::create($save);
        return \response()->json(['success' => 'student added successfully']);
    }

    function teachers_students_edit($id)
    {
        $data = User::where('id',$id)->first();
        return response()->json(['status'=>200,'student'=>$data]);
    }

    function teachers_students_update(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:10',
            'address' => 'required',

        ]);

        $update = [
            'name' => $request->name,
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
        User::where('id',$request->s_id)->update($update);
        return \response()->json(['success' => 'student update successfully']);
        // return redirect('teachers/students')->with('success','student update successfully');
    }

    function teachers_students_delete(Request $request)
    {
        // dd($request->st_id);
        User::where('id',$request->st_id)->delete();
        return \response()->json(['success' => 'delete data successfully']);

    }

}

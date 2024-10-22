<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentsController extends Controller
{
    function student_dashboard()
    {
        return view('admin.users.studentdashboard');
    }

    function student_details(Request $request)
    {
        $students_id = $request->session()->get('loginUser')->id;
        $data = User::where('id',$students_id)->first();
        return view('admin.users.students.details',compact('data'));
    }
    function student_edit(Request $request)
    {
        $students_id = $request->session()->get('loginUser')->id;
        $data = User::where('id',$students_id)->first();
        return \response()->json(['status'=>200,'student'=>$data]);
    }
    function student_update(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:10',
            'address' => 'required',

        ]);

        $update = [
            'name'=>$request->name,
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
        User::where('id',$request->std_id)->update($update);
        return response()->json(['success' => 'Students update successfully']);
        // return redirect('students/details')->with('success','Students update successfully');
    }

}

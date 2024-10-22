<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    public function admin_change_password($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['status' => 200, 'data' => $data]);
    }
    public function admin_update_password(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'c_password' => 'same:newpassword',
        ]);

        $data = User::where('id', $request->af_id)->first();
        if (Hash::check($request->oldpassword, $data->password)) {
            $update = ['password' => Hash::make($request->newpassword)];
            User::where('id', $request->af_id)->update($update);

            return response()->json([
                'status' => true,
                'msg' => 'Your password changed successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'old password is worng',
            ]);
        }
    }
    public function admin_teachers_change_password($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['status' => 200, 'data' => $data]);
    }
    public function admin_teachers_update_password(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'confirm_password' => 'same:newpassword',
        ]);
        $data = User::where('id', $request->atp_id)->first();
        if (Hash::check($request->oldpassword, $data->password)) {
            $update = ['password' => Hash::make($request->newpassword)];
            $data = User::where('id', $request->atp_id)->update($update);
            return response()->json([
                'status' => true,
                'msg' => 'Your password changed successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'old password is worng',
            ]);
        }
    }

    public function admin_students_change_password($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['status' => 200, 'data' => $data]);
    }

    public function admin_students_update_password(Request $request)
    {

        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'confirm_password' => 'same:newpassword',
        ]);

        $data = User::where('id', $request->asp_id)->first();

        if (Hash::check($request->oldpassword, $data->password)) {
            $update = ['password' => Hash::make($request->newpassword)];
            User::where('id', $request->asp_id)->update($update);
            return response()->json([
                'status' => true,
                'msg' => 'Your password changed successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'old password is worng',
            ]);
        }
    }

    public function teachers_change_password($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['status' => 200, 'data' => $data]);
    }
    public function teachers_password_update(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'confirm_password' => 'same:newpassword',
        ]);
        $data = User::where('id', $request->tp_id)->first();
        if (Hash::check($request->oldpassword, $data->password)) {
            $update = ['password' => Hash::make($request->newpassword)];
            User::where('id', $request->tp_id)->update($update);

            return response()->json([
                'status' => true,
                'msg' => 'Your password changed successfully',
            ]);
        } else {
            return \response()->json([
                'status' => false,
                'msg' => 'old password is worng',
            ]);
        }
    }

    public function teachers_students_password_changes($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['status' => 200, 'data' => $data]);
    }

    public function teachers_students_password_update(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'confirm_password' => 'same:newpassword',
        ]);
        $data = User::where('id', $request->tsp_id)->first();
        if (Hash::check($request->oldpassword, $data->password)) {
            $update = ['password' => Hash::make($request->newpassword)];
            User::where('id', $request->tsp_id)->update($update);

            return response()->json([
                'status' => true,
                'msg' => 'Your password changed successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'old password is worng',
            ]);
        }
    }
    public function student_password($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['ststus' => 200, 'data' => $data]);
    }
    public function student_update_password(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'confirm_password' => 'same:newpassword',
        ]);
        $data = User::where('id', $request->sp_id)->first();
        if (Hash::check($request->oldpassword, $data->password)) {
            $update = ['password' => Hash::make($request->newpassword)];
            User::where('id', $request->sp_id)->update($update);
            return response()->json([
                'status' => true,
                'message' => 'Your password changed successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'old password is worng',
            ]);
        }
    }

}

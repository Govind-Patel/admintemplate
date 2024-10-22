<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;
use  App\Http\Controllers\AdminController;
use  App\Http\Controllers\TeacherController;
use  App\Http\Controllers\StudentsController;
use  App\Http\Controllers\EmployeeController;
use  App\Http\Controllers\ForgetPasswordController;
use  App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('register_data',[UserController::class,'register_data']);
Route::post('login_user',[UserController::class,'login_user']);
Route::get('logout_user',[UserController::class,'logout_user']);

//admin section  start
Route::get('admin/login',[UserController::class,'loginform_show']);
Route::get('admin/register',[UserController::class,'registerform_show']);

Route::get('admin/dashboard',[AdminController::class,'dashboard'])->middleware('admin');
Route::get('admin/detail',[AdminController::class,'admin_details']);
Route::get('admin/change_password/{id}',[ForgetPasswordController::class,'admin_change_password']);
Route::post('admin/update_password/',[ForgetPasswordController::class,'admin_update_password']);
Route::get('admin/edit/{id}',[AdminController::class,'admin_edit']);
Route::post('admin/update/',[AdminController::class,'admin_update']);
Route::post('admin/add/teachers',[AdminController::class,'admin_add_teacher']);
Route::get('admin/teachers/details',[AdminController::class,'admin_teachers_details']);
Route::get('admin/students/details',[AdminController::class,'admin_students_details']);
Route::post('admin/students/add',[AdminController::class,'admin_students_add']);
Route::post('admin/students/search',[AdminController::class,'admin_students_search']);
Route::get('admin/teachers/edit/{id}',[AdminController::class,'admin_teachers_edit']);
Route::post('admin/teachers/update',[AdminController::class,'admin_teachers_update']);
Route::get('admin/teachers/delete',[AdminController::class,'admin_teachers_delete']);
Route::get('admin/students/edit/{id}',[AdminController::class,'admin_students_edit']);
Route::post('admin/students/update',[AdminController::class,'admin_students_update']);
Route::get('admin/students/delete/',[AdminController::class,'admin_students_delete']);

//admin section  end

//teachers section start
Route::get('teachers/dashboard',[TeacherController::class,'teachers_dashboard'])->middleware('teacher');
Route::get('teachers/details',[TeacherController::class,'teachers_details']);
Route::get('teachers/edit/{id}',[TeacherController::class,'teachers_edit']);
Route::post('teachers/update/',[TeacherController::class,'teachers_update']);
Route::get('teachers/delete/',[TeacherController::class,'teachers_delete']);
Route::post('teachers/students/add',[TeacherController::class,'teachers_students_add']);
Route::get('teachers/students',[TeacherController::class,'teachers_students']);
Route::get('teachers/students/edit/{id}',[TeacherController::class,'teachers_students_edit']);
Route::post('teachers/students/update/',[TeacherController::class,'teachers_students_update']);
Route::get('teachers/students/delete/',[TeacherController::class,'teachers_students_delete']);

//teachers section end

//students section start
Route::get('students/dashboard',[StudentsController::class,'student_dashboard'])->middleware('student');
Route::get('students/details',[StudentsController::class,'student_details']);
Route::get('students/edit/{id}',[StudentsController::class,'student_edit']);
Route::post('students/update',[StudentsController::class,'student_update']);
//students section end

// how to use yajra
Route::get('employee',[EmployeeController::class,'index']);

// change password in all fiels statrt
Route::get('admin/teachers/change-password/{id}',[ForgetPasswordController::class,'admin_teachers_change_password']);
Route::post('admin/teachers/update-password/',[ForgetPasswordController::class,'admin_teachers_update_password']);

Route::get('admin/students/change-password/{id}',[ForgetPasswordController::class,'admin_students_change_password']);
Route::post('admin/students/update-password',[ForgetPasswordController::class,'admin_students_update_password']);

Route::get('teachers/change-password/{id}',[ForgetPasswordController::class,'teachers_change_password']);
Route::post('teachers/password-update/',[ForgetPasswordController::class,'teachers_password_update']);

Route::get('teachers/students/password-changes/{id}',[ForgetPasswordController::class,'teachers_students_password_changes']);
Route::post('teachers/students/password-update/',[ForgetPasswordController::class,'teachers_students_password_update']);

Route::get('students/password/{id}',[ForgetPasswordController::class,'student_password']);
Route::post('students/password/update/',[ForgetPasswordController::class,'student_update_password']);
// change password in all fiels end

// chat box start
Route::post('students/password/update/',[ChatRequestController::class,'student_update_password']);

// chat box end
Route::get('chatrequest/{id}',[ChatController::class,'chatrequest']);
Route::post('chat_save/',[ChatController::class,'chat_save']);
Route::get('chat/show/{id}',[ChatController::class,'chat_show']);

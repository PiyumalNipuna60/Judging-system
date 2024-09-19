<?php

use App\Http\Controllers\AdminControllers;
use App\Http\Controllers\DistrictControllers;
use App\Http\Controllers\DistrictDetailControllers;
use App\Http\Controllers\MarkControllers;
use App\Http\Controllers\StudentControllers;
use App\Http\Controllers\TeacherControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//admin api
Route::post('/login', [AdminControllers::class, 'login'])->name('login');
Route::post('/register', [AdminControllers::class, 'register'])->name('register');
Route::get('/logout', [AdminControllers::class, 'logout'])->name('logout');

//admin api
Route::get('/getAllUser', [AdminControllers::class, 'getAllUser']);
Route::get('/userDetails', [AdminControllers::class, 'userDetails'])->name('userDetails');
Route::put('/userUpdate/{id}', [AdminControllers::class, 'userUpdate'])->name('userUpdate');


Route::post('/send_otp', [AdminControllers::class, 'sendOTP']);
Route::post('/verify_otp', [AdminControllers::class, 'verifyOTP']);
Route::post('/change_password', [AdminControllers::class, 'changePassword']);



//teacher api
Route::post('/save_teacher', [TeacherControllers::class, 'saveTeacher'])->name('saveTeacher');
Route::get('/search_teacher/{input}', [TeacherControllers::class, 'searchTeacher'])->name('searchTeacher');
Route::get('/get_all_teacher', [TeacherControllers::class, 'getAllTeacher']);
Route::put('/update_teacher/{id}', [TeacherControllers::class, 'updateTeacher'])->name('updateTeacher');
Route::delete('/delete_teacher/{id}', [TeacherControllers::class, 'deleteTeacher'])->name('deleteTeacher');


//district api
Route::post('/save_district', [DistrictControllers::class, 'saveDistrict'])->name('saveDistrict');
Route::get('/search_district/{input}', [DistrictControllers::class, 'searchDistrict'])->name('searchDistrict');
Route::get('/get_all_district', [DistrictControllers::class, 'getAllDistrict']);
Route::put('/update_district/{id}', [DistrictControllers::class, 'updateDistrict'])->name('updateDistrict');
Route::delete('/delete_district/{id}', [DistrictControllers::class, 'deleteDistrict'])->name('deleteDistrict');

//district details api
Route::post('/save_district_detail', [DistrictDetailControllers::class, 'saveDistrictDetail'])->name('saveDistrictDetail');
Route::get('/search_district_detail/{input}', [DistrictDetailControllers::class, 'searchDistrictDetail'])->name('searchDistrictDetail');
Route::get('/get_all_district_detail', [DistrictDetailControllers::class, 'getAllDistrictDetail']);
Route::put('/update_district_detail/{id}', [DistrictDetailControllers::class, 'updateDistrictDetail'])->name('updateDistrictDetail');
Route::delete('/delete_district_detail/{id}', [DistrictDetailControllers::class, 'deleteDistrictDetail'])->name('deleteDistrictDetail');

//student api
Route::post('/save_student', [StudentControllers::class, 'saveStudent'])->name('saveStudent');
Route::get('/get_all_student', [StudentControllers::class, 'getAllStudents']);
Route::delete('/delete_student/{id}', [StudentControllers::class, 'deleteStudent'])->name('deleteStudent');
Route::post('/update_student/{id}', [StudentControllers::class, 'updateStudent'])->name('updateStudent');

//Mark api
Route::post('/save_mark', [MarkControllers::class, 'saveMark'])->name('saveMark');
Route::get('/get_all_mark', [MarkControllers::class, 'getAllMarks']);
Route::delete('/delete_mark/{id}', [MarkControllers::class, 'deleteMark'])->name('deleteMark');
Route::put('/update_mark/{id}', [MarkControllers::class, 'updateMark'])->name('updateMark');



Route::group(['middleware' => ['auth:sanctum']], function () {
});

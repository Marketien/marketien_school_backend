<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\TeacherController;

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
    return view('enterPage');
});
Route::get('/admin-login',[AdminController::class,'adminLogin']);
Route::post('/admin-check',[AdminController::class,'check']);
Route::group(['name'=>'admin', 'middleware'=>'adminpages'], function(){
    Route::get('/admin-main',[AdminController::class,'adminMain']);
    Route::get('student-list',[studentController::class,'studentList']);
    Route::get('/student-approval',[studentController::class,'studentApproval']);
    Route::get('/student-accept/{id}',[studentController::class,'studentApproved']);
    Route::get('/student-form',[studentController::class,'studentForm']);
    Route::post('/addStudent',[studentController::class,'addStudent']);
//    Route::post('/student-delete',[studentController::class,'studentDelete'])->name('deleteStudent');
//    Route::get('/student-info/{id}',[studentController::class,'getStudentInformation'])->name('studentInfo');
    // Route::get('/student-delete/{id}',[studentController::class,'studentDelete']);
    Route::get('/student-edit/{id}',[studentController::class,'updateForm']);
    Route::post('/update-student',[studentController::class,'studentUpdate']);
    Route::get('/logout-admin',[AdminController::class,'logoutAdmin']);
    Route::get('/student-payment-detail/{id}',[studentController::class,'studentPaymentDetail']);


    Route::get('/teacher-list',[TeacherController::class,'TeacherList'])->name('teacher-list');
    Route::get('/add-teacher-form',[TeacherController::class,'AddTeacherForm'])->name('add-teacher-form');
    Route::post('/add-teacher',[TeacherController::class,'AddTeacher'])->name('add-teacher');
    Route::get('/update-teacher-form/{id}',[TeacherController::class,'UpdateTeacherForm'])->name('update-teacher-form');
    Route::post('/update-teacher',[TeacherController::class,'UpdateTeacher'])->name('update-teacher');
    Route::get('/teacher-delete/{id}',[TeacherController::class,'teacherDelete']);

});


Route::get('/student-signup-form',[studentController::class,'studentSignUpForm']);
Route::get('/student-login',[studentController::class,'studentLogin']);
Route::post('/student-check',[studentController::class,'Scheck']);
Route::post('/reg-Student',[studentController::class,'studentReg']);

Route::group(['name'=>'student', 'middleware'=>'studentpages'], function(){
Route::get('/student-detail',[studentController::class,'studentDetail']);
Route::get('/payment-form',[PaymentController::class,'paymentForm'])->middleware('otpPay');
// Route::get('/get-student-name',[PaymentController::class,'getStudent'])->name('get-student-name');
Route::get('/logout-student',[studentController::class,'logoutStudent']);


Route::get('/otp/login',[OtpController::class,'OtpLogin'])->name('otp-login');
Route::post('/otp/generate',[OtpController::class,'OtpGenerate'])->name('otp-generate');
Route::get('/otp/verification/{user_id}',[OtpController::class,'OtpVerify'])->name('otp-verify');
Route::post('/otp/entry',[OtpController::class,'OtpEntry'])->name('otp-entry')->Middleware('otpPay');
});




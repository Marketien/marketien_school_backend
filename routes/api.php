<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SyllabusController;
use App\Models\Routine;
use App\Models\Teacher;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     // return $request->user();
    
// });
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::group(['middleware' => 'adminApi'], function(){
        //admin student api
        Route::get('/student-list',[studentController::class,'studentListApi'])->name('student-list-api');
        Route::get('/pending-student-list',[studentController::class,'studentApprovalApi'])->name('pending-student-list-api');
        Route::delete('/student-delete/{id}',[studentController::class,'studentDeleteApi'])->name('student-delete-api');
        Route::get('/student-edit/{id}',[studentController::class,'updateFormApi'])->name('studen-edit-information');
        Route::post('/student-update',[studentController::class,'UpdateStudentApi'])->name('student-update-api');
        Route::get('/admin-student-detail/{id}',[studentController::class,'AdminStudentDetailApi'])->name('admin-student-detail');
        Route::get('/student-approve/{id}',[studentController::class,'studentApprovedApi'])->name('student-approve-api');
        Route::post('/admin-student-reg',[studentController::class,'adminStudentRegApi'])->name('admin-student-reg-api');

        //admin teacher api
        Route::post('/add-teacher',[TeacherController::class,'AddTeacherApi'])->name('add-teacher-api');
        Route::get('/teacher-edit/{id}',[TeacherController::class,'UpdateTeacherFormApi'])->name('teacher-edit-information');
        Route::post('/teacher-update',[TeacherController::class,'UpdateTeacherApi'])->name('teacher-update-api');
        Route::delete('/teacher-delete/{id}',[TeacherController::class,'teacherDeleteApi'])->name('teacher-delete-api');
    
        //   admin Notice Api
        
        Route::post('/add-notice',[NoticeController::class,'addNoticeApi'])->name('add-notice-api');
        Route::delete('/notice-delete/{id}',[NoticeController::class,'noticeDeleteApi'])->name('notice-delete-api');
        Route::get('/notice-edit/{id}',[NoticeController::class,'UpdateNoticeFormApi'])->name('notice-edit-information');
        Route::post('/notice-update',[NoticeController::class,'UpdateNoticeApi'])->name('notice-update-api');

        //Admin Routine Api

        Route::post('/add-routine',[RoutineController::class,'addRoutineApi'])->name('add-routine-api');
        Route::delete('/routine-delete/{id}',[RoutineController::class,'routineDeleteApi'])->name('routine-delete-api');
        Route::get('/routine-edit/{id}',[RoutineController::class,'UpdateRoutineFormApi'])->name('routine-edit-information');
        Route::post('/routine-update',[RoutineController::class,'UpdateRoutineApi'])->name('routine-update-api');
          
        //Admin Syllubus Api
        
        Route::post('/add-syllabus',[SyllabusController::class,'addSyllabusApi'])->name('add-syllabus-api');
        Route::delete('/syllabus-delete/{id}',[SyllabusController::class,'syllabusDeleteApi'])->name('syllabus-delete-api');
        Route::get('/syllabus-edit/{id}',[SyllabusController::class,'UpdateSyllabusFormApi'])->name('syllabus-edit-information');
        Route::post('/syllabus-update',[SyllabusController::class,'UpdateSyllabusApi'])->name('syllabus-update-api');
         //admin Payment Api

         Route::get('pending-payment',[PaymentController::class,'getPendingPaymentApi'])->name('pending-payment');
         Route::get('/payment-approve/{id}',[PaymentController::class,'paymentApprovedApi'])->name('payment-approve-api');
         Route::get('/approved-payment',[PaymentController::class,'getApprovedPaymentApi'])->name('approved-payment');
         Route::get('/payment-history/{studentId}',[PaymentController::class,'getPaymentHistory'])->name('payment-history');
         

    });
    Route::group(['middleware' => 'studentApi'], function(){
        Route::get('/student-detail',[studentController::class,'studentDetailApi'])->name('student-detail-api');
        Route::post('/student-logout',[UserController::class,'studentLogoutApi'])->name('student-logout-api');
    });

    });
 // vue private api
Route::get('/get-student-name',[PaymentController::class,'getStudent'])->name('get-student-name');
Route::post('/store-payment',[PaymentController::class,'storePayment']);



// open api woithout middleware
Route::post("/login",[UserController::class,'check']);
Route::post('/student-reg',[studentController::class,'studentRegApi'])->name('student-reg-api');
Route::get('/teacher-listApi',[TeacherController::class,'TeacherListApi'])->name('teacher-list-api');
Route::get('/notice-listApi',[NoticeController::class,'noticeListApi'])->name('notice-list-api');
Route::get('/routine-listApi',[RoutineController::class,'routineListApi'])->name('routine-list-api');
Route::get('/syllabus-listApi',[SyllabusController::class,'syllabusListApi'])->name('syllabus-list-api');

Route::get('unpaid-student',[PaymentController::class,'unpaidStudents']);


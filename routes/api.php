<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\UserController;

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
        
        Route::get('/student-list',[studentController::class,'studentListApi'])->name('student-list-api');
        Route::get('/pending-student-list',[studentController::class,'studentApprovalApi'])->name('pending-student-list-api');
        Route::delete('/student-delete/{id}',[studentController::class,'studentDeleteApi'])->name('student-delete-api');
    });
    Route::get('/student-detail',[studentController::class,'studentDetailApi'])->name('student-detail-api');
    Route::post('/student-logout',[UserController::class,'studentLogoutApi'])->name('student-logout-api');
    });

Route::get('/get-student-name',[PaymentController::class,'getStudent'])->name('get-student-name');
Route::post('/store-payment',[PaymentController::class,'storePayment']);




Route::post("/login",[UserController::class,'check']);
Route::post('/student-reg',[studentController::class,'studentRegApi'])->name('student-reg-api');
Route::get('/teacher-listApi',[TeacherController::class,'TeacherListApi'])->name('teacher-list-api');
Route::delete('/student-delete/{id}',[studentController::class,'studentDeleteApi'])->name('student-delete-api');


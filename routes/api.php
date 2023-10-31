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
        Route::get('/teacher-listApi',[TeacherController::class,'TeacherListApi'])->name('teacher-list-api');
    });
    Route::get('/student-detail',[studentController::class,'studentDetailApi'])->name('student-detail-api');
    });
// Route::group(['name'=>'payment', 'middleware'=>'studentpages'], function(){
//     Route::get('/get-student-name',[PaymentController::class,'getStudent']);
// });
Route::get('/get-student-name',[PaymentController::class,'getStudent'])->name('get-student-name');
Route::post('/store-payment',[PaymentController::class,'storePayment']);




Route::post("/login",[UserController::class,'check']);

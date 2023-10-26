<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function paymentForm(){
        $data = Student::where('id',session('loggedStudent'))->first();
        
        return view('Payment.studentPayment',['stdn'=>$data]);
    }
    public function getStudent(){
        $data = Student::where('id',session('loggedStudent'))->first();
        return response()->json($data);
    }
    public function storePayment(Request $req){
        $data = new Payment;
        $data->studentId = $req->id;
        $data->name = $req->name;
        $data->regNo = $req->regNo;
        $data->class = $req->class;
        $data->months = $req->month;
        $data->amount = $req->amount;
        $data->save();
    }
}

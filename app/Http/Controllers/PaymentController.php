<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function paymentForm()
    {
        $data = Student::where('id', session('loggedStudent'))->first();

        return view('Payment.studentPayment', ['stdn' => $data]);
    }
    public function getStudent()
    {
        $data = Student::where('id', session('loggedStudent'))->first();
        return response()->json($data);
    }
    public function storePayment(Request $req)
    {
        $data = new Payment;
        $data->studentId = $req->id;
        $data->name = $req->name;
        $data->regNo = $req->regNo;
        $data->class = $req->class;
        $data->months = $req->month;
        $data->amount = $req->amount;
        $data->transactionId = $req->transactionId;
        $data->payment_status = $req->payment_status;
        $data->save();
    }
    public function getPendingPaymentApi()
    {
        $data = Payment::where('payment_status', '1')->get();
        return response([
            'payment' => $data
        ]);
    }
    public function paymentApprovedApi($id)
    {
        $data = Payment::find($id);
        $data->payment_status = 2;
        $result = $data->save();
        if ($result) {
            return response([
                'message' => 'Success, This student is approved',
                'status' => '202'
            ]);
        } else {
            return response([
                'message' => 'Fail, Something went wrong',
                'status' => '202'
            ]);
        }
    }
    public function getApprovedPaymentApi()
    {
        $data = Payment::where('payment_status', '2')->get();
        return response([
            'payment' => $data
        ]);
    }
    public function getPaymentHistory($studentId)
    {
        $data = Payment::where('studentId', $studentId)->get();
        $student = Student::where('id', $studentId)->first();
        $allMonths = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
        $payable = [];
        $currentMonth = date("m");
        $result = [];
        $getMonths = [];
        foreach ($data as $pmt) {
            // $month = implode(',',$pmt->months);
            $getMonths[] = $pmt->months;
        }
        $size = count($getMonths);
        if($size === 1){
            $result[] = $getMonths[0];
        }else{
            for ($s = 0; $s < $size; $s++) {
                if ($s + 1 < $size)
                    $result[] = array_merge($getMonths[$s], $getMonths[$s + 1]);
            }         
        }
        for ($s = 0; $s < $size; $s++) {
            if ($s + 1 < $size)
                $result[] = array_merge($getMonths[$s], $getMonths[$s + 1]);
        }
        for ($i = 0; $i < $currentMonth; $i++) {
            if (!in_array($allMonths[$i], $result[0])) {;
                $payable[] = $allMonths[$i];
            }
        }
        if($payable){
            $student['unpaid'] = $payable;
        }
        else{
            $student['unpaid'] = ['Payment completed'];
        }
        
        return response([
            'payment' => $data,
            'student' => $student
        ]);
    }
    public function unpaidStudents()
    {
        $unpaidStudent=[];
        $data = Student::all();
        foreach ($data as $std) {
            $allMonths = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
            $payable = [];
            $currentMonth = date("m");
            $result = [];
            $getMonths = [];
            $payment = Payment::where('studentId', $std->id)->get();
            foreach ($payment as $pmt) {
                // $month = implode(',',$pmt->months);
                $getMonths[] = $pmt->months;
            }
            $size = count($getMonths);
            for ($s = 0; $s < $size; $s++) {
                if ($s + 1 < $size)
                    $result = array_merge($getMonths[$s], $getMonths[$s + 1]);
            }
            for ($i = 0; $i < $currentMonth; $i++) {
                if (!in_array($allMonths[$i], $result)) {;
                    $payable[] = $allMonths[$i];
                }
            }
            if($payable){
             $unpaidStudent[] = $std;
            }
        }
        return $unpaidStudent;
    }
    // public function getUnpaidHistory($id){
    //     $allMonths = array('january','february','march','april','may','june','july','august','september','october','november','december');
    //     $payable = [];
    //     $currentMonth = date("m");
    //     $data = Student::where('id',$id)->first();
    //     $result =[];
    //     $getMonths=[];
    //     $payment = Payment::where('studentId',$data->id)->get();
    //         foreach($payment as $pmt){
    //             // $month = implode(',',$pmt->months);
    //             $getMonths[] = $pmt->months;
    //         }


    //         $size = count($getMonths);
    //         for($s = 0; $s<$size;$s++){
    //             if($s + 1 < $size)
    //          $result[] = array_merge($getMonths[$s],$getMonths[$s+1]);
    //         }



    //         for ($i = 0;$i<$currentMonth;$i++){
    //             if(!in_array($allMonths[$i],$result[0])){;
    //              $payable[] = $allMonths[$i];
    //             }

    //         }


    //     return $payable;
    // }
}

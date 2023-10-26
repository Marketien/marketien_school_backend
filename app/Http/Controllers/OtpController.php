<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\UserOtp;

class OtpController extends Controller
{
    public function OtpLogin(){
        return view('Otp.otpLogin');
    }
    public function OtpGenerate(Request $req){
        $req->validate([
            'mobileNo'=> 'required|exists:students,phoneNo'
        ]);
        $userOtp = $this->Generate($req->mobileNo);
        $userOtp->sendSMS($req->mobileNo);
        return redirect()->route('otp-verify',[$userOtp->user_id])
        ->with('success','OTP has been sent on your phone');
    }
    public function Generate($mobileNo){
    
     $user = Student::where('phoneNo',$mobileNo)->first();
     $userOtp = UserOtp::where('user_id',$user->id)->latest()->first(); 
     $now = now();
        if($userOtp && $now->isBefore($userOtp->expire_at)){
            return $userOtp;
         }
         return UserOtp::create([
            'user_id'=> $user->id,
            'otp' => rand(123456, 999999),
            'expire_at'=> $now->addMinutes(10),
            'status'=> 1,
         ]);
     
     
    }
    public function OtpVerify($user_id){
         return view('Otp.otpVerification')->with([
            'user_id'=>$user_id
         ]);
    }
    public function OtpEntry(Request $req){
        $req->validate([
          'otp'=>'required',
          'user_id'=> 'required|exists:students,id'
        ]);
        $userOtp = UserOtp::where('user_id',$req->user_id)->where('otp',$req->otp)->first();
        $now = now();
        if(!$userOtp){
            return redirect()->back()->with('error','your otp is incorrect');
        }
        elseif($userOtp && $now->isAfter($userOtp->expire_at)){
            return redirect()->back()->with('error','your otp has been expired');
        }
        // $oldOtp = UserOtp::where('status',2)->get();
        $user = Student::whereId($req->user_id)->first();
        if($user){
            UserOtp::where('status',2)->where('user_id',$user->id)->delete();
          $userOtp->update([
            'expire_at'=>now(),
            'status' => 2,
          ]);
          return redirect('payment-form');
        }
        return redirect()->route('otp-login')->with('error','your otp is incorrect');

    }
}

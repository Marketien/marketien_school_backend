<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\UserOtp;

class OtptoPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        $user = Student::where('id',session('loggedStudent'))->first();
        $data = UserOtp::where('user_id',$user->id)->latest()->first();
        // $now = now();

        if(!$data)
        {
        
            return redirect('/otp/login')->with('error','you should pass Otp first');
        }
        return $next($request);
    }
}

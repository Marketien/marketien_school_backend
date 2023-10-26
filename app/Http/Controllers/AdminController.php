<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminMain(){
        return view('Admin.admin');
    }
    public function adminLogin(){
        return view('Admin.adminlogin');
    }
    public function check(Request $req){
        $req ->validate([
            'email'=>'required|email',
            'password'=> 'required|min:5|max:12'
        ]);
        $user = Admin::where('email','=',$req->email)->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                $req->session()->put('loggedUser',$user->id);
                return redirect('admin-main');
            }
            else{
                return back()->with('fail','Invalid password');
            }
        }
        else{
            return back()->with('fail','No account for this email');
        }
}
public function logoutAdmin(){
    if(session()->has('loggedUser')){
      session()->pull('loggedUser');
      return redirect('/');
    }
  }
}

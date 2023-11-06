<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function check(Request $req){
        $req ->validate([
            'email'=>'required|email',
            'password'=> 'required|min:5|max:12'
        ]);
        $user = User::where('email','=',$req->email)->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                // $req->session()->put('loggedUser',$user->id);
                // return redirect('admin-main');
                $token = $user->createToken('my-app-token')->plainTextToken;
                $response = [
                    'user' => $user,
                    'token' => $token,
                    'status'=>'201'
                ];
                return response($response);
            }
            else{
                return response([
                    'message' => ['invalid Password'],
                    'status'=>'403'
                ]);
            }
        }
        else{
            return response([
                'message' => ['These credentials do not match our records.'],
                'status'=>'404'
            ]);
        }
}
public function studentLogoutApi(Request $request){
    $request->user()->currentAccessToken()->delete();
    return response([
        'message' => ['logged out successfully'],
        'status'=>'405'
    ]);
}
}







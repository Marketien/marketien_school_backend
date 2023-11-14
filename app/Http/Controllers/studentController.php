<?php

namespace App\Http\Controllers;

use App\Http\Middleware\StudentApi;
use App\Models\Student;
use App\Models\UserOtp;
use App\Models\Payment;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\response;
// use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    public function studentList(){
        $std = Student::where('status',2)->get();
        return view('Admin.Student.studentList',['students'=>$std]);
    }
    // list api
    public function studentListApi(){
        $std = Student::where('status',2)->get();
        return response([
            'student'=> $std
        ]) ;
    }
    public function studentApproval(){
        $std = Student::where('status',1)->get();
        return view('Admin.Student.studentApproval',['students'=>$std]);
    }
    //approval api
    public function studentApprovalApi(){
        $std = Student::where('status',1)->get();
        return response([
            'student'=> $std
        ]) ;
    }
    public function studentForm(){
        return view('Admin.Student.addStudent');
    }
    public function addStudent(Request $req){
        $req->validate([
           'name'=>'required',
            'fatherName'=>'required',
            'motherName'=>'required',
            'birthDate'=>'required',
            'phoneNo'=>'required',
            'email'=>'required',
            'password'=>'required',
            'address'=>'required',
            'class'=>'required',
            'section'=>'required',
            'image'=>'required',
            'rollNo'=>'required',
            'regNo'=>'required'
        ]);
        $data = New User();
        $data->name = $req->name;
        $data->email = $req->email;
        $data->role = 2;
        $data->password = Hash::make($req->password);
        $data->save();
        $user = New Student();
        $user->status = 2;
        $user->name = $req->name;
        $user->fatherName = $req->fatherName;
        $user->motherName = $req->motherName;
        $user->birthDate = $req->birthDate;
        $user->phoneNo = $req->phoneNo;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->address = $req->address;
        $user->class = $req->class;
        $user->section = $req->section;
        $user->rollNo = $req->rollNo;
        $user->regNo = $req->regNo;
        $file = $req->file('image');
        $extension = $file->getClientOriginalExtension();
        $fileName =time().'.'.$extension;
        $file->move('image/upload',$fileName);
        $user->image = $fileName;
        $result = $user->save();
        if($result){
            return back()->with('success','you added a student Successfully');
        }
        else{
            return back()->with('Fail','something Went Wrong');
        }

    }
    public function adminStudentRegApi(Request $req){
        // $req->validate([
        // //    'name'=>'required',
        // //     'fatherName'=>'required',
        // //     'motherName'=>'required',
        // //     'birthDate'=>'required',
        // //     'phoneNo'=>'required',
        //     'email'=>'required|email|unique:students',
        //     // 'password'=>'required',
        //     // 'address'=>'required',
        //     // 'class'=>'required',
        //     // 'section'=>'required',
        //     // 'image'=>'required',
        //     // 'rollNo'=>'required',
        //     // 'regNo'=>'required'
        // ]);
        $validator = Validator::make($req->all(), [
        'email'=>'required|email|unique:students'
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => '203',
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }
        else{
            $user = New Student();
            $user->status = 1;
            $user->name = $req->name;
            $user->fatherName = $req->fatherName;
            $user->motherName = $req->motherName;
            $user->birthDate = $req->birthDate;
            $user->phoneNo = $req->phoneNo;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->address = $req->address;
            $user->class = $req->wclass;
            $user->section = $req->section;
            $user->rollNo = $req->rollNo;
            $user->regNo = $req->regNo;
            if($file = $req->file('image')){
                $extension = $file->getClientOriginalExtension();
                $fileName =time().'.'.$extension;
                $file->move('image/upload',$fileName);
                $user->image = $fileName;
            }
            else{
                unset($user['image']);
            }
            $result = $user->save();
            if($result){
                return response([
                  'message'=>'Successfully added a student',
                  'status'=>'201'
                ]);
            }
            else{
                return response([
                    'message'=>'failed, Something Went Wrong',
                    'status'=>'202'
                  ]);
            }
        }
       
    }
//    public function getStudentInformation(Request $request){
//        $user = Student::where('id',$request->id)->first();
//        return $user;
//    }
//
//    function studentDelete(Request $request){
//        Student::where('id',$request->id)->delete();
//        return redirect('product-list')->with('message','Successful! Product Deleted Successfully');
//    }

//delete api
public function studentDeleteApi($id){
    
        $data = Student::find($id);
        if(!$data){
            return response([
                "message"=>'student doesnt exist',
                "status"=> 202
            ]);
        }else{
            $data->delete();
            return response([
                "message"=>'student deleted successfuly',
                "status"=> 201
            ]);
        }
       
}
public function updateForm($id){
        $data = Student::find($id);
        return view('Admin.Student.updateStudent',['std'=>$data]);

}
public function updateFormApi($id){
    $data = Student::find($id);
    $data['wclass'] = $data['class'];
    unset($data['class']);
    // $data['clasx'] = $data->class;
    return response([
       'user'=> $data,    
    ]);

}
public function studentUpdate(Request $req){
        $data = Student::find($req->id);
        $user = Student::where('id',$data->id)->first();
        if($user->status == 2){
            $data->name = $req->name;
            $data->fatherName = $req->fatherName;
            $data->motherName = $req->motherName;
            $data->birthDate = $req->birthDate;
            $data->phoneNo = $req->phoneNo;
            $data->email = $req->email;
            // $user->password = $req->password;
            $data->address = $req->address;
            $data->class = $req->class;
            $data->section = $req->section;
            $data->rollNo = $req->rollNo;
            $data->regNo = $req->regNo;
            if($file = $req->file('image')){
                $extension = $file->getClientOriginalExtension();
                $fileName =time().'.'.$extension;
                $file->move('image/upload',$fileName);
                $data->image = $fileName;
            }
            else{
                unset($data['image']);
            }
            $result = $data-> save();
            if($result){
                    return redirect('/student-list')->with('message','Student Updated successfully'); 
                }
            else{
                return back()->with('Fail','something went wrong');
            }  
        }
        else{
            $data->name = $req->name;
            $data->fatherName = $req->fatherName;
            $data->motherName = $req->motherName;
            $data->birthDate = $req->birthDate;
            $data->phoneNo = $req->phoneNo;
            $data->email = $req->email;
            // $user->password = $req->password;
            $data->address = $req->address;
            $data->class = $req->class;
            $data->section = $req->section;
            $data->rollNo = $req->rollNo;
            $data->regNo = $req->regNo;
            if($file = $req->file('image')){
                $extension = $file->getClientOriginalExtension();
                $fileName =time().'.'.$extension;
                $file->move('image/upload',$fileName);
                $data->image = $fileName;
            }
            else{
                unset($data['image']);
            }
            $result = $data-> save();
            if($result){
                    return redirect('/student-approval')->with('message','Student Updated successfully'); 
                }
            else{
                return back()->with('Fail','something went wrong');
            }

        }
   



}
public function UpdateStudentApi(Request $req){
    $data = Student::find($req->id);
    $data->name = $req->name;
    $data->fatherName = $req->fatherName;
    $data->motherName = $req->motherName;
    $data->birthDate = $req->birthDate;
    $data->address = $req->address;
    $data->class = $req->wclass;
    $data->section = $req->section;
    $data->rollNo = $req->rollNo;
    $data->regNo = $req->regNo;
    $data->phoneNo = $req->phoneNo;
    $data->email = $req->email;
    if($file = $req->file('image')){
      $extension = $file->getClientOriginalExtension();
      $fileName =time().'.'.$extension;
      $file->move('image/upload',$fileName);
      $data->image = $fileName;
  }
  else{
      unset($data['image']);
  }
  $result = $data-> save();
  if($result){
      return response([
        'message'=>'Student Edited Successfully',
        'status' => 201
      ]); 
  }
else{
    return response([
        'message'=>'Something went wrong ',
        'status' => 202
      ]); 
}
}
public function studentSignUpForm(){
    return view('Student.studentSignUp');
}
public function studentLogin(){
    return view('Student.studentLogin');
}
public function Scheck(Request $req){
    $req ->validate([
        'email'=>'required|email',
        'password'=> 'required|min:5|max:12'
    ]);
    $user = Student::where('email','=',$req->email)->first();
    if($user){
        if(Hash::check($req->password,$user->password)){
            $req->session()->put('loggedStudent',$user->id);
            return redirect('student-detail');
        }
        else{
            return back()->with('fail','Invalid password');
        }
    }
    else{
        return back()->with('fail','No account for this email');
    }
}
public function studentDetail(){
    $data = Student::where('id',session('loggedStudent'))->first();
    return view('Student.studentDetail',['stdn'=>$data]);
}
//api 
public function studentDetailApi(){
    $data = Student::where('email',auth()->user()->email)->first();
    $fileName = $data->image;
    $path = asset('/image/upload/'. $fileName );
    // $path = public_path().'/image/upload/'.$fileName;
    // $file = Response::download($path);
    return response()->json([
        'user'=> $data,
        'file'=> $path
    ]);
}
public function AdminStudentDetailApi($id){
    $data = Student::find($id);
    $payment = Payment::where('studentId',$id)->get();
    $fileName = $data->image;
    $path = asset('/image/upload/'. $fileName );
    // $path = public_path().'/image/upload/'.$fileName;
    // $file = Response::download($path);
    return response()->json([
        'user'=> $data,
        'file'=> $path,
        'payment'=>$payment
    ]);
}
public function logoutStudent(){
    if(session()->has('loggedStudent')){
        $data = Student::where('id',session('loggedStudent'))->first();
        UserOtp::where('status',2)->where('user_id',$data->id)->delete();
      session()->pull('loggedStudent');
      return redirect('/');
    }
  }
  //Api
public function studentRegApi(Request $req){
    $req->validate([
    //    'name'=>'required',
    //     'fatherName'=>'required',
    //     'motherName'=>'required',
    //     'birthDate'=>'required',
    //     'phoneNo'=>'required',
        'email'=>'required|email|unique:users',
        // 'password'=>'required',
        // 'image'=>'required',
    ]);
    // $data = New User();
    // $data->name = $req->name;
    // $data->email = $req->email;
    // $data->role = 2;
    // $data->password = Hash::make($req->password);
    // $data->save();
    $date = strtotime($req->birthDate);
    $formatDate = date('Y-m-d', $date);
    $user = New Student();
    $user->status = 1;
    $user->name = $req->name;
    $user->fatherName = $req->fatherName;
    $user->motherName = $req->motherName;
    // $user->birthDate =  $req->birthDate;
    $user->birthDate =  $formatDate;
    $user->phoneNo = $req->phoneNo;
    $user->email = $req->email;
    $user->password = Hash::make($req->password);
    if($req->hasFile('image')){
        $file =$req['image'];
        $extension = $file->getClientOriginalExtension();
        $fileName =time().'.'.$extension;
        $file->move('image/upload',$fileName);
        $user->image = $fileName;
    }
    else{
        unset($user['image']);
    }
    $result = $user->save();
    if($result){
        return response([
          'message'=>'Successfull, Wait for the approval',
          'status'=>'201'
        ]);
    }
    else{
        return response([
            'message'=>'failed, Something Went Wrong',
            'status'=>'202'
          ]);
    }

}
//api//
public function studentReg(Request $req){
    $req->validate([
       'name'=>'required',
        'fatherName'=>'required',
        'motherName'=>'required',
        'birthDate'=>'required',
        'phoneNo'=>'required',
        'email'=>'required|email|unique',
        'password'=>'required',
        'image'=>'required',
    ]);
    $data = New User();
    $data->name = $req->name;
    $data->email = $req->email;
    $data->role = 2;
    $data->password = Hash::make($req->password);
    $data->save();
    $user = New Student();
    $user->status = 1;
    $user->name = $req->name;
    $user->fatherName = $req->fatherName;
    $user->motherName = $req->motherName;
    $user->birthDate = $req->birthDate;
    $user->phoneNo = $req->phoneNo;
    $user->email = $req->email;
    $user->password = Hash::make($req->password);
    $file = $req->file('image');
    $extension = $file->getClientOriginalExtension();
    $fileName =time().'.'.$extension;
    $file->move('image/upload',$fileName);
    $user->image = $fileName;
    $result = $user->save();
    if($result){
        return back()->with('success','Wait for the approval');
    }
    else{
        return back()->with('Fail','something Went Wrong');
    }

}
public function studentApproved($id){
    $data = Student::find($id);
    $data->status = 2;
    $data->save();
    User::create([
       'name'=> $data->name,
       'email'=> $data->email,
       'password'=>$data->password,
       'role'=> '2'
    ]);
    return redirect()->back()->with('message','Student Approved');

}
public function studentApprovedApi($id){
    $data = Student::find($id);
    $data->status = 2;
    $result = $data->save();
    User::create([
       'name'=> $data->name,
       'email'=> $data->email,
       'password'=>$data->password,
       'role'=> '2'
    ]);
    if($result){
        return response([
            'message'=>'Success, This student is approved',
            'status'=>'202'
          ]);
    }
    else{
        return response([
            'message'=>'Fail, Something went wrong',
            'status'=>'202'
          ]);
    }
   
}
public function studentPaymentDetail($id){
     $data = Student::find($id);
     $user = Payment::where('studentId',$data->id)->get();
     return view('Admin.Student.studentPaymentDetail',['stdn'=>$data,'payments'=>$user]);

}


}

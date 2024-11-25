<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function TeacherList()
    {
        $data = Teacher::all();
        return view('Teacher.teacherList', ['teachers' => $data]);
    }
    //for Api
    public function TeacherListApi()
    {
        $data = Teacher::all();
        $teacher=[];

        foreach($data as $user){
        $fileName = $user->image;
        $path = asset('/image/upload/'. $fileName );
         $user['imglink'] = $path;
         unset($user['image']);
        $teacher[]= $user;
    }
        return response([
            'teacher' => $teacher,
        ]);

    }
    // for inner html

    public function AddTeacherForm()
    {
        return view("Teacher.addTeacher");
    }
    public function AddTeacher(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'designation' => 'required',
            'phoneNo' => 'required',
            'email' => 'required',
            'image' => 'required',
        ]);

        $data = new Teacher();
        $data->name = $req->name;
        $data->designation = $req->designation;
        $data->subject = $req->subject;
        $data->phoneNo = $req->phoneNo;
        $data->email = $req->email;
        $file = $req->file('image');
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '.' . $extension;
        $file->move('image/upload', $fileName);
        $data->image = $fileName;
        $result = $data->save();
        if ($result) {
            return back()->with('success', 'you added a teacher Successfully');
        } else {
            return back()->with('Fail', 'something Went Wrong');
        }
    }
    // for api
    public function AddTeacherApi(Request $req)
    {
        $req->validate([

            'email' => 'required|email',

        ]);

        $data = new Teacher();
        $data->name = $req->name;
        $data->designation = $req->designation;
        $data->subject = $req->subject;
        $data->phoneNo = $req->phoneNo;
        $data->email = $req->email;
        if ($file = $req->file('image')) {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('image/upload', $fileName);
            $data->image = $fileName;
        } else {
            unset($data['image']);
        }
        $result = $data->save();
        if ($result) {
            return response([
                'message' => 'Teacher added Successfully',
                'status' => '201'
            ]);
        } else {
            return response([
                'message' => 'Something went wrong',
                'status' => '202'
            ]);
        }
    }
    // for inner html
    public function UpdateTeacherForm($id)
    {
        $data = Teacher::find($id);
        return view('Teacher.updateTeacher', ['teacher' => $data]);
    }
    // for api
    public function UpdateTeacherFormApi($id)
    {
        $data = Teacher::find($id);
        return response([
            'user' => $data,
        ]);
    }
// for inner html
    public function UpdateTeacher(Request $req)
    {
        $data = Teacher::find($req->id);
        $data->name = $req->name;
        $data->designation = $req->designation;
        $data->subject = $req->subject;
        $data->phoneNo = $req->phoneNo;
        $data->email = $req->email;
        if ($file = $req->file('image')) {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('image/upload', $fileName);
            $data->image = $fileName;
        } else {
            unset($data['image']);
        }
        $result = $data->save();
        if ($result) {
            return redirect('/teacher-list')->with('message', 'Teacher Updated successfully');
        } else {
            return back()->with('Fail', 'something went wrong');
        }
    }
    // for api
    public function UpdateTeacherApi(Request $req)
    {
        $data = Teacher::find($req->id);
        $data->name = $req->name;
        $data->designation = $req->designation;
        $data->subject = $req->subject;
        $data->phoneNo = $req->phoneNo;
        $data->email = $req->email;
        if ($file = $req->file('image')) {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('image/upload', $fileName);
            $data->image = $fileName;
        } else {
            unset($data['image']);
        }
        $result = $data->save();
        if ($result) {
            return response([
                'message' => 'Teacher updated Successfully',
                'status' => '201'
            ]);
        } else {
            return response([
                'message' => 'somthing went wrong',
                'status' => '202'
            ]);
        }
    }
    // for inner html
    public function teacherDelete($id)
    {
        $data = Teacher::find($id);
        $data->delete();
        return redirect('teacher-list')->with('message', 'Teacher deleted Successfully');
    }
// for api
    public function teacherDeleteApi($id)
    {
        $data = Teacher::find($id);
        if(!$data){
            return response([
                "message"=>'teacher doesnt exist',
                "status"=> 202
            ]);
        }else{
            $data->delete();
            return response([
                "message"=>'teacher deleted successfuly',
                "status"=> 201
            ]);
        }
    }

}

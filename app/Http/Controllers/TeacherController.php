<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    //

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
    public function AddTeacherApi(Request $req)
    {
        $req->validate([
            //    'name'=> 'required',
            //    'designation'=>'required',
            //    'phoneNo'=>'required',
            'email' => 'required|email',
            // 'image'=>'required',
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
    public function UpdateTeacherForm($id)
    {
        $data = Teacher::find($id);
        return view('Teacher.updateTeacher', ['teacher' => $data]);
    }
    public function UpdateTeacherFormApi($id)
    {
        $data = Teacher::find($id);
        return response([
            'user' => $data,
        ]);
    }

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
    public function teacherDelete($id)
    {
        $data = Teacher::find($id);
        $data->delete();
        return redirect('teacher-list')->with('message', 'Teacher deleted Successfully');
    }
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}

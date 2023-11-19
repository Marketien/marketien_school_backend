<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Syllabus;

class SyllabusController extends Controller
{
    public function syllabusListApi()
    {
        $data = Syllabus::get();
        $syllabus = [];
        foreach($data as $slb){
            $fileName = $slb->pdf;
        $path = asset('pdf/upload/'. $fileName );   
         $slb['pdflink'] = $path;
         unset($slb['pdf']); 
         $time = $slb->created_at;
         $date = $time->format('d/m/Y');
         $slb['date'] = $date;
         unset($slb['created_at']);
         $syllabus[]= $slb;
        }
        return response([
            'syllabus' => $syllabus
        ]);
    }
    public function addSyllabusApi(Request $req)
    {
        $data = new Syllabus();
        $data->title = $req->title;
        $data->class = $req->wClass;
        $data->subject = $req->subject;
        if ($file = $req->file('pdf')) {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('pdf/upload', $fileName);
            $data->pdf = $fileName;
        } else {
            unset($data['pdf']);
        }
        $result = $data->save();
        if ($result) {
            return response([
                'message' => 'Syllabus added Successfully',
                'status' => '201'
            ]);
        } else {
            return response([
                'message' => 'Something went wrong',
                'status' => '202'
            ]);
        }
    }
    public function UpdateSyllabusFormApi($id)
    {
        $data = Syllabus::find($id);
        $data['wClass'] = $data['class'];
        unset($data['class']);
        
        return response([
            'user' => $data,
        ]);
    }
    public function UpdateSyllabusApi(Request $req)
    {
        $data = Syllabus::find($req->id);
        $data->title = $req->title;
        $data->class = $req->wClass;
        $data->subject = $req->subject;
        if ($file = $req->file('pdf')) {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $file->move('pdf/upload', $fileName);
            $data->pdf = $fileName;
        } else {
            unset($data['pdf']);
        }
        $result = $data->save();
        if ($result) {
            return response([
                'message' => 'Syllabus updated Successfully',
                'status' => '201'
            ]);
        } else {
            return response([
                'message' => 'somthing went wrong',
                'status' => '202'
            ]);
        }
    }
    public function syllabusDeleteApi($id)
    {
        $data = Syllabus::find($id);
        if(!$data){
            return response([
                "message"=>'syllabus doesnt exist',
                "status"=> 202
            ]);
        }else{
            $data->delete();
            return response([
                "message"=>'syllabus deleted successfuly',
                "status"=> 201
            ]);
        }
    }
}

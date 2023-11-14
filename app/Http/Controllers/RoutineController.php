<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;

class RoutineController extends Controller
{
    public function routineListApi()
    {
        $data = Routine::get();
        $routine = [];
        foreach($data as $rtn){
            $fileName = $rtn->pdf;
        $path = asset('pdf/upload/'. $fileName );   
         $rtn['pdflink'] = $path;
         unset($rtn['pdf']); 
         $time = $rtn->created_at;
         $date = $time->format('d/m/Y');
         $rtn['date'] = $date;
         unset($rtn['created_at']);
         $routine[]= $rtn;
        }
        return response([
            'routine' => $routine
        ]);
    }
    public function addRoutineApi(Request $req)
    {
        $data = new Routine();
        $data->title = $req->title;
        $data->class = $req->wClass;
        $data->section = $req->section;
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
                'message' => 'Routine added Successfully',
                'status' => '201'
            ]);
        } else {
            return response([
                'message' => 'Something went wrong',
                'status' => '202'
            ]);
        }
    }
    public function UpdateRoutineFormApi($id)
    {
        $data = Routine::find($id);
        $data['wClass'] = $data['class'];
          unset($data['class']);
        return response([
            'user' => $data,
        ]);
    }
    public function UpdateRoutineApi(Request $req)
    {
        $data = Routine::find($req->id);
        $data->title = $req->title;
        $data->class = $req->wClass;
        $data->section = $req->section;
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
                'message' => 'Routine updated Successfully',
                'status' => '201'
            ]);
        } else {
            return response([
                'message' => 'somthing went wrong',
                'status' => '202'
            ]);
        }
    }
    public function routineDeleteApi($id)
    {
        $data = Routine::find($id);
        if(!$data){
            return response([
                "message"=>'routine doesnt exist',
                "status"=> 202
            ]);
        }else{
            $data->delete();
            return response([
                "message"=>'routine deleted successfuly',
                "status"=> 201
            ]);
        }
    }
}

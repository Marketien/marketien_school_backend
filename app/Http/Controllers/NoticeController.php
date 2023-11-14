<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function noticeListApi()
    {
        $data = Notice::get();
        $notice = [];
        foreach($data as $ntc){
            $fileName = $ntc->pdf;
        $path = asset('pdf/upload/'. $fileName );   
         $ntc['pdflink'] = $path;
         unset($ntc['pdf']); 
         $time = $ntc->created_at;
         $date = $time->format('d/m/Y');
         $ntc['date'] = $date;
         unset($ntc['created_at']);
        $notice[]= $ntc;
        }
        return response([
            'notice' => $notice
        ]);
    }
    public function addNoticeApi(Request $req)
    {
        $data = new Notice();
        $data->title = $req->title;
        $data->description = $req->description;
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
                'message' => 'Ntice added Successfully',
                'status' => '201'
            ]);
        } else {
            return response([
                'message' => 'Something went wrong',
                'status' => '202'
            ]);
        }
    }
    public function UpdateNoticeFormApi($id)
    {
        $data = Notice::find($id);
        return response([
            'user' => $data,
        ]);
    }
    public function UpdateNoticeApi(Request $req)
    {
        $data = Notice::find($req->id);
        $data->title = $req->title;
        $data->description = $req->description;
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
                'message' => 'Notice updated Successfully',
                'status' => '201'
            ]);
        } else {
            return response([
                'message' => 'somthing went wrong',
                'status' => '202'
            ]);
        }
    }
    public function noticeDeleteApi($id)
    {
        $data = Notice::find($id);
        if(!$data){
            return response([
                "message"=>'notice doesnt exist',
                "status"=> 202
            ]);
        }else{
            $data->delete();
            return response([
                "message"=>'notice deleted successfuly',
                "status"=> 201
            ]);
        }
    }
}

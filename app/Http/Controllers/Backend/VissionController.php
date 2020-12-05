<?php

namespace App\Http\Controllers\Backend;

use App\Model\Vission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VissionController extends Controller
{
    public function view(){
        $data['countVission'] = Vission::count();
        $data['allData'] = Vission::all();
        return view('backend.vission.view-vission',$data);
    }

    public function add(){
       return view('backend.vission.add-vission');
    }

    public function store(Request $request){

        $data = new Vission();
        $data->title  = $request->title;
        $data->created_by  = Auth::user()->id;
         if ($request->file('image')) {
                $file = $request->file('image');
                $fileName =date('YmdHi').$file->getClientOriginalExtension();
                $file->move(public_path('upload/vission_images/'), $fileName);
                $data['image'] = $fileName;
            }
        $data->save();

        return redirect()->route('vissions.view')->with('success','Data Inserted Successfully');

    }


     public function edit($id){
            $editData = Vission::findOrfail($id);
           return view('backend.vission.edit-vission',compact('editData'));

    }


    public function update(Request $request, $id ){
        $data = Vission::findOrfail($id);
        $data->title  = $request->title;
        $data->updated_by  = Auth::user()->id;
        if ($request->file('image')) {
                $file = $request->file('image');
                 @unlink(public_path('upload/vission_images/'.$data->image));
                $fileName =date('YmdHi').$file->getClientOriginalExtension();
                $file->move(public_path('upload/vission_images/'), $fileName);
                $data['image'] = $fileName;
            }

        $data->save();

        return redirect()->route('vissions.view')->with('success','Data updated Successfully');

    }

    public function delete($id){

        $vission = Vission::findOrfail($id);
        if(file_exists('upload/vission_images/' . $vission->image) AND ! empty($vission->image)){
            unlink('upload/vission_images/' . $vission->image);
        }
        $vission->delete();
       return redirect()->route('vissions.view')->with('success','Data Deleted Successfully');
    }

}

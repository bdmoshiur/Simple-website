<?php

namespace App\Http\Controllers\Backend;

use App\Model\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{


public function view(){
        $data['allData'] = Service::all();
        return view('backend.service.view-service',$data);
    }

    public function add(){
       return view('backend.service.add-service');
    }

    public function store(Request $request){

        $data = new Service();
        $data->short_title  = $request->short_title;
        $data->long_title  = $request->long_title;
        $data->created_by  = Auth::user()->id;
        $data->save();

        return redirect()->route('services.view')->with('success','Data Inserted Successfully');

    }


     public function edit($id){
            $editData = Service::findOrfail($id);
           return view('backend.service.edit-service',compact('editData'));

    }


    public function update(Request $request, $id ){
        $data = Service::findOrfail($id);
        $data->short_title  = $request->short_title;
        $data->long_title  = $request->long_title;
        $data->updated_by  = Auth::user()->id;

        $data->save();

        return redirect()->route('services.view')->with('success','Data updated Successfully');

    }

    public function delete($id){

        $service = Service::findOrfail($id);
        $service->delete();
       return redirect()->route('services.view')->with('success','Data Deleted Successfully');
    }






}

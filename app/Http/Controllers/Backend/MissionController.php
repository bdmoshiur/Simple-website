<?php

namespace App\Http\Controllers\Backend;

use App\Model\Mission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
       public function view(){
        $data['countMission'] = Mission::count();
        $data['allData'] = Mission::all();
        return view('backend.mission.view-mission',$data);
    }

    public function add(){
       return view('backend.mission.add-mission');
    }

    public function store(Request $request){

        $data = new Mission();
        $data->title  = $request->title;
        $data->created_by  = Auth::user()->id;
         if ($request->file('image')) {
                $file = $request->file('image');
                $fileName =date('YmdHi').$file->getClientOriginalExtension();
                $file->move(public_path('upload/mission_images/'), $fileName);
                $data['image'] = $fileName;
            }
        $data->save();

        return redirect()->route('missions.view')->with('success','Data Inserted Successfully');

    }


     public function edit($id){
            $editData = Mission::findOrfail($id);
           return view('backend.mission.edit-mission',compact('editData'));

    }


    public function update(Request $request, $id ){
        $data = Mission::findOrfail($id);
        $data->title  = $request->title;
        $data->updated_by  = Auth::user()->id;
        if ($request->file('image')) {
                $file = $request->file('image');
                 @unlink(public_path('upload/mission_images/'.$data->image));
                $fileName =date('YmdHi').$file->getClientOriginalExtension();
                $file->move(public_path('upload/mission_images/'), $fileName);
                $data['image'] = $fileName;
            }

        $data->save();

        return redirect()->route('missions.view')->with('success','Data updated Successfully');

    }

    public function delete($id){

        $mission = Mission::findOrfail($id);
        if(file_exists('upload/mission_images/' . $mission->image) AND ! empty($mission->image)){
            unlink('upload/mission_images/' . $mission->image);
        }
        $mission->delete();
       return redirect()->route('missions.view')->with('success','Data Deleted Successfully');
    }






}

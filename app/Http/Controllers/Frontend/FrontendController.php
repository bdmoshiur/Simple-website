<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Logo;
use App\Model\About;
use App\Model\Slider;
use App\Model\Contact;
use App\Model\Mission;
use App\Model\Service;
use App\Model\Vission;
use App\Model\NewsEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Communicate;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index(){

        $data['logo'] = Logo::first();
        $data['sliders'] = Slider::all();
        $data['contact'] = Contact::first();
        $data['mission'] = Mission::first();
        $data['vission'] = Vission::first();
        $data['services'] = Service::all();
        $data['news_events'] = NewsEvent::orderBy('id','DESC')->get();
        return view('frontend.layouts.home',$data);
    }

    public function aboutUs(){
        $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
         $data['abouts'] = About::first();
        return view('frontend.single_pages.about-us',$data);
    }

    public function contactUs(){
        $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
        return view('frontend.single_pages.contact_us',$data);

    }
    public function mission(){
         $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
         $data['mission'] = Mission::first();
            return view('frontend.single_pages.mission',$data);
    }

     public function vission(){
         $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
           $data['vission'] = Vission::first();
            return view('frontend.single_pages.vission',$data);
    }


     public function newsEvents(){
         $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
         $data['news_events'] = NewsEvent::orderBy('id','DESC')->get();
            return view('frontend.single_pages.news-events',$data);
    }

     public function newsDetails($id){
         $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
         $data['news'] = NewsEvent::find($id);
            return view('frontend.single_pages.news-event-details',$data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:communicates,email',
            'mobile_no' => 'required',
            'address' => 'required',
            'msg' => 'required',
        ]);


        $communicate = new Communicate();
        $communicate->name = $request->name;
        $communicate->email = $request->email;
        $communicate->mobile_no = $request->mobile_no;
        $communicate->address = $request->address;
        $communicate->msg = $request->msg;
        $communicate->save();

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'msg' => $request->msg,
        );

        Mail::send('frontend.emails.contact', $data, function ($message) use($data) {
            $message->from('moshiurcse888@gmail.com', 'Moshiur');
            $message->to($data['email'],'Moshiur');
            $message->subject('Thanks for contacts');
        });

        return redirect()->back()->with('success','Data Send Successfully');


    }







}

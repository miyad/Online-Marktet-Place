<?php

namespace App\Http\Controllers;

use App\Application_model;
use App\Shop_model;
use App\Shopowner_model;
use App\Http\User;
use Mail;
use Carbon;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    
    public function viewavailableshops()
    {
        $shops= Shop_model::select('*')->where ('isrent',0)->where('bookedstatus',0)->get(); 
        return view('application.viewavailableshops',compact('shops'));
    }

    public function apply_shop($id=null)
    {
        $admin=0;
        return view('application.apply_shop',compact('id'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|max:255|unique:applications,email',
            'mobile'=>'required',
        ]);
        $data=$request->all();
        
        //$shopdata=Shop_model::select('id','shopid','area','price','shopownerid','shop_name','description','isrent','bookedstatus','rentdate','expireddate','floor')->where('id',$request->get('shopid'))->first();
        $shop=Shop_model::findOrFail($request->get('shopid'));
        $shop->bookedstatus=1;
        $shop->save();
        $app=Application_model::create($data);
        $app->shopid=$shop->id;
        $app->save();
        $shops= Shop_model::select('*')->where ('isrent',0)->where('bookedstatus',0)->get(); 
        return view('application.viewavailableshops',compact('shops'));
    }

    
    public function showapplications0()
    {
        $menu_active=6;
        
            $applications= Application_model::select('*')->where ('status',0)->get(); 
        return view('application.showapplications0',compact('applications','menu_active'));
    }
    public function showapplications1()
    {
        $menu_active=6;
            $applications= Application_model::select('*')->where ('status',1)->get(); 
        return view('application.showapplications1',compact('applications','menu_active'));
    }

    public function givetime($id=null)
    {
        $application=Application_model::findOrFail($id);
        $data = array('name'=>"From Big Mart: ", 'email' => $application->email,
    'password'=>"--",'shop_id'=>"--",'mobile'=>$application->mobile);
        Mail::send(['text'=>'mail'], $data, function($message) use ($data){
            $message->to($data['email'], 'Tutorials Point')->subject
               ('Appointment:See attached file.');
            $message->attach('C:\ALL\Project\TC.txt');
            $message->from('nazmulhasnsakib@gmail.com','Big Mart');
         });
         $application->status=1;
         $application->save();
         $menu_active=6;
         $applications= Application_model::select('*')->where ('status',0)->get(); 
        return view('application.showapplications0',compact('applications','menu_active'));
    }

    public function giveShop($id=null)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];


        $string = str_shuffle($pin);
        
        $application=Application_model::findOrFail($id);

        $shop=Shop_model::select('*')->where ('id',$application->shopid)->first();
 
        $shopowner = array('name'=>$application->name,
        'email'=>$application->email,
        'address'=>$application->address,
        'city'=>$application->city,
        'country'=>$application->country,
        'mobile'=>$application->mobile,
        'password'=>$string,
        'shop_id'=>$shop->shopid
        );  

        Mail::send(['text'=>'mail'], $shopowner, function($message) use ($shopowner){
            $message->to($shopowner['email'], '')->subject
               ('Shop Assignment');
            $message->attach('C:\ALL\Project\TC.txt');
            $message->from('nazmulhasnsakib@gmail.com','Big Mart');
         });

         $shopowner['password']=Hash::make($string);
         $spon=Shopowner_model::create($shopowner);
         DB::table('users')->insert(
            ['name'=>$application->name,
        'email'=>$application->email,
        'address'=>$application->address,
        'city'=>$application->city,
        'password'=>$shopowner['password'],
        'mobile'=>$application->mobile,
        'admin'=>2
            ]
        );
         $shop->shopownerid=$spon->id;
         $shop->isrent=1;
         $shop->rentdate= Carbon\Carbon::now()->toDateString();
         $shop->expireddate = Carbon\Carbon::now()->addYears(1);
         $shop->save();
         DB::table('applications')->where('id', $id)->delete();

        $menu_active=6;
        $applications= Application_model::select('*')->where ('status',1)->get(); 
        return view('application.showapplications1',compact('applications','menu_active'));
    }

    public function deleteApplication($id)
    {
        $i=0;
        DB::table('applications')->where('id', $id)->delete();
        if($i==0)return view('application.showapplications0',compact('applications','menu_active'));
        else return view('application.showapplications1',compact('applications','menu_active'));
    }

}
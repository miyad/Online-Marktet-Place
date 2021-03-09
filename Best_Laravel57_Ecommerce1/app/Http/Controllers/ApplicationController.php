<?php

namespace App\Http\Controllers;

use App\Application_model;
use App\Shop_model;
use App\Shopowner_model;
use App\Deliveryman_model;
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
    'password'=>"--",'shopid'=>"--",'mobile'=>$application->mobile);
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

        $shop=Shop_model::where('id',$application->shopid)->first();
 
        $shopowner = array('name'=>$application->name,
        'email'=>$application->email,
        'address'=>$application->address,
        'city'=>$application->city,
        'country'=>$application->country,
        'mobile'=>$application->mobile,
        'password'=>$string,
        'shopid'=>$shop->shopid,
        );  

        Mail::send(['text'=>'mail'], $shopowner, function($message) use ($shopowner){
            $message->to($shopowner['email'], '')->subject
               ('Shop Assignment');
            $message->attach('C:\ALL\Project\TC.txt');
            $message->from('nazmulhasnsakib@gmail.com','Big Mart');
         });

         $shopowner['password']=Hash::make($string);
         $shopowner['shopid']=$shop->id;
         $spon=Shopowner_model::create($shopowner);

         $spon=Shopowner_model::where('shopownerid',$spon->shopownerid)->first();
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
         $updatedshop=Shop_model::findOrFail($shop->id);
         $updatedshop->shopownerid=$spon->shopownerid;
         $updatedshop->isrent=1;
         $updatedshop->rentdate= Carbon\Carbon::now()->toDateString();
         $updatedshop->expireddate = Carbon\Carbon::now()->addYears(1);
         $updatedshop->save();
         DB::table('applications')->where('id', $id)->delete();

        $menu_active=6;
        $applications= Application_model::select('*')->where ('status',1)->get();
        $spon->update([
            'shopid' => $shop->id,
        ]);
        return view('application.showapplications1',compact('applications','menu_active'));
    }

    public function deleteApplication0($id)
    {
        $menu_active=6;
        
        $application=Application_model::findOrFail($id);
        $shop=Shop_model::where('id',$application->shopid)->first();
        $shop->update([
            'bookedstatus' => 0,
        ]);
        $application->delete();
        $applications= Application_model::select('*')->where ('status',0)->get(); 
        return view('application.showapplications0',compact('applications','menu_active'));
    }
    public function deleteApplication1($id)
    {
        $menu_active=6;
        
        $application=Application_model::findOrFail($id);
        $shop=Shop_model::where('id',$application->shopid)->first();
        $shop->update([
            'bookedstatus' => 0,
            'isrent'=> 0
        ]);
        $application->delete();
        $applications= Application_model::select('*')->where ('status',1)->get(); 
        return view('application.showapplications1',compact('applications','menu_active'));
       
    }

    public function showDeliveryMan()
    {
        $menu_active=8;
        $delmen=Deliveryman_model::all();
        return view('backEnd.showDeliveryMan',compact('delmen','menu_active'));
    }

    public function addNewDM()
    {
        $menu_active=8;
        return view('backEnd.addNewDM',compact('menu_active'));
    }

    public function storeNewDM(Request $request)
    {
        $this->validate($request,[
            'email'=>'max:255|unique:deliveryman,email',
            'mobile'=>'required',
        ]);
        $menu_active=8;
        $data=$request->all();
        $app=Deliveryman_model::create($data);
        return view('backEnd.addNewDM',compact('menu_active'))->with('message','Add delman success!!!');
    }

    public function deldelman($id)
    {
        Deliveryman_model::findOrFail($id)->delete();
        return back()->with('message','Delete delman success');
    }
    

}
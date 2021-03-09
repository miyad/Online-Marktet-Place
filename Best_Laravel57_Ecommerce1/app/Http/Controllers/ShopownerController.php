<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Shopowner_model;
use App\Products_model;
use App\Shop_model;
use Session;
use DB;
use Illuminate\Support\Str;

class ShopownerController extends Controller
{
    public function index(){
        $uid=Auth::user()->email;
        $user=DB::table('shopowners')->where('email',$uid)->first();
        $user=Shopowner_model::findOrFail($user->shopownerid);
        $shop=Shop_model::where('shopownerid',$user->shopownerid)->first();
        if($user->shopid==0)
        {
            // $user->update([
            //     'shopid' => $shop->id,
            // ]);
            $user->shopid=$shop->id;
            $user->save();
        }
        
        $menu_active=1;
        return view('shopowner.index',compact('menu_active'));
    }
    public function settings(){
        $menu_active=0;
        return view('shopowner.setting',compact('menu_active'));
    }
    public function chkPassword(Request $request){
        $data=$request->all();
        $current_password=$data['pwd_current'];
        $email_login=Auth::user()->email;
        $check_pwd=User::where(['email'=>$email_login])->first();
        if(Hash::check($current_password,$check_pwd->password)){
            echo "true"; die();
        }else {
            echo "false"; die();
        }
    }
    public function updatSOPwd(Request $request){
        $data=$request->all();
        $current_password=$data['pwd_current'];
        $email_login=Auth::user()->email;
        $check_password=User::where(['email'=>$email_login])->first();
        if(Hash::check($current_password,$check_password->password)){
            $password=bcrypt($data['pwd_new']);
            User::where('email',$email_login)->update(['password'=>$password]);
            return redirect('/shopowner/settings')->with('message','Password Update Successfully');
        }else{
            return redirect('/shopowner/settings')->with('message','InCorrect Current Password');
        }
    }


    

}
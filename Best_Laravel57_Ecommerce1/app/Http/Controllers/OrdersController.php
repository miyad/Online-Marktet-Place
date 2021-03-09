<?php

namespace App\Http\Controllers;

use App\Cart_model;
use App\Orders_model;
use App\Deliveryman_model;
use App\Orderedproduct_model;
use App\Coupon_model;
use PDF;

use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function index(){
        $session_id=Session::get('session_id');
        $cart_datas=Cart_model::where('session_id',$session_id)->get();
        $total_price=0;
        foreach ($cart_datas as $cart_data){
            $total_price+=$cart_data->price*$cart_data->quantity;
        }
        $shipping_address=DB::table('delivery_address')->where('users_id',Auth::id())->first();
        return view('checkout.review_order',compact('shipping_address','cart_datas','total_price'));
    }
    public function order(Request $request){
        $input_data=$request->all();
        if($input_data['grand_total']==0)
        {
            return back()->with('message','NO  Product Ordered !!');
        }
        $input_data['grand_total']=$input_data['grand_total']+$input_data['shipping_charges'];
        $payment_method=$input_data['payment_method'];
        $order=Orders_model::create($input_data);
        if($payment_method=="COD"){
            return redirect('/cod/'. $order->id);
        }else{
            return redirect('/paypal');
        }
    }
    public function cod($orid){
        $session_id=Session::get('session_id');
        $user_order=Orders_model::where('users_id',Auth::id())->
                                  where('id',$orid)->first();
        $cart_datas=Cart_model::where('session_id',$session_id)->get();
        $total_price=0;
        foreach ($cart_datas as $cart_data){
            $total_price+=$cart_data->price*$cart_data->quantity;
            $op = array('order_id' => $orid,
                'products_id' => $cart_data->products_id,
                'product_name' => $cart_data->product_name,
                'product_code' => $cart_data->product_code,
                'product_color' => $cart_data->product_color,
                'size' => $cart_data->size,
                'price'=>$cart_data->price,
                'quantity'=>$cart_data->quantity);
                DB::table('orderedproduct')->insert($op);
            DB::table('cart')->where('id', $cart_data->id)->delete();
        }
        $shipping_address=DB::table('delivery_address')->where('users_id',Auth::id())->first();
        //return view('checkout.review_order',compact('shipping_address','cart_datas','total_price'));
        
        return view('payment.cod',compact('user_order','shipping_address','cart_datas','total_price','orid'));
    }
    public function paypal(Request $request){
        $who_buying=Orders_model::where('users_id',Auth::id())->first();
        return view('payment.paypal',compact('who_buying'));
    }

    public function download(Request $request)
    {
        $input_data=$request->all();
        $pdf = PDF::loadView('myPDF', $input_data);
        return $pdf->download('order_details.pdf');
    }

    public function show($id)
    {
        $menu_active=7;
        
        if($id==1)
        {
            $flag="pending";
            $orders = Orders_model::where('order_status', 'LIKE', '%'.$flag.'%')->get();
            return view('backEnd.orders.showorder',compact('menu_active','orders','id'));
        }
        else if($id==2)
        {
            $flag="assigned";
            $orders = Orders_model::where('order_status', 'LIKE', '%'.$flag.'%')->get();
            return view('backEnd.orders.showorder',compact('menu_active','orders','id'));
        }
        else
        {
            $flag="completed";
            $orders = Orders_model::where('order_status', 'LIKE', '%'.$flag.'%')->get();
            return view('backEnd.orders.showorder',compact('menu_active','orders','id'));
        }
        
    }

    public function assign($id)
    {
        $order=Orders_model::findOrFail($id);
        $delman=Deliveryman_model::where('isavailable',0)->first();
       
        if($delman==null)
        {
            return back()->with('message','No deliveryman available!!!');
        }
        $order->order_status = "assigned";
        $order->deliveryman_id = $delman->id;
        
        $delman->update([
            'isavailable' => 1
        ]);
        $order->save();
        return back()->with('message','Assign Order Already!');
        
    }

    public function complete($id)
    {
        $order=Orders_model::findOrFail($id);
        $delman=Deliveryman_model::where('id',$order->deliveryman_id)->first();

        $order->order_status = "completed";
        
        $delman->update([
            'isavailable' => 0
        ]);
        $order->save();
        return back()->with('message','Complete Order Now!');
        
    }

    public function destroy($id)
    {
        $delete_order=Orders_model::findOrFail($id);
        $delete_order->delete();
        return back()->with('message','Delete Order Already!');
    }
}

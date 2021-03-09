<?php

namespace App\Http\Controllers;

use App\Shop_model;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_active=0;
        $shops=Shop_model::all();
        return view('backEnd.shop.index',compact('menu_active','shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_active=5;
        
        return view('backEnd.shop.create',compact('menu_active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkCateName(Request $request){
        $data=$request->all();
        $shop_id=$data['shopid'];
        $ch_cate_id_atDB=Shop_model::select('shopname')->where('shopid',$shop_id)->first();
        if($shop_name==$ch_cate_name_atDB['shopname']){
            echo "true"; die();
        }else {
            echo "false"; die();
        }
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'shopid'=>'required|max:255|unique:shops,shop_name',
            'area'=>'required',
        ]);
        $data=$request->all();
        Shop_model::create($data);
        return redirect()->route('shop.index')->with('message','Added Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu_active=0;
        $edit_shop=Shop_model::findOrFail($id);
        return view('backEnd.shop.edit',compact('edit_shop','menu_active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_shops=Shop_model::findOrFail($id);
        $this->validate($request,[
            'shopid'=>'required|max:255|unique:shops,shop_name,'.$update_shops->id,
        ]);
        
        $input_data=$request->all();
        if(empty($input_data['bookedstatus'])){
            $input_data['bookedstatus']=0;
        }
        if(empty($input_data['isrent'])){
            $input_data['isrent']=0;
        }
        $update_shops->update($input_data);
        if($update_shops->isrent==0)
        {
            $update_shops->rentdate=null;
            $update_shops->expireddate=null;
        }
        $update_shops->save();
        return redirect()->route('shop.index')->with('message','Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=Shop_model::findOrFail($id);
        $delete->shopownerid=null;
        $delete->bookedstatus=0;
        $delete->isrent=0;
        $delete->save();
        //$delete->delete();
        return redirect()->route('shop.index')->with('message','Remove shopowner Success!');
    }
}

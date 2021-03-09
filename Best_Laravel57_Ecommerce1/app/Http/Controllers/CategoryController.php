<?php

namespace App\Http\Controllers;

use App\Category_model;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid=Auth::user()->email;
        $user=DB::table('shopowners')->where('email',$uid)->first();
        if($user==null)
        {
            $menu_active=0;
            $categories=Category_model::all();
            return view('backEnd.category.index',compact('menu_active','categories'));
        }
        else
        {
            $menu_active=0;
            $categories=Category_model::all();
            return view('shopowner.category.index',compact('menu_active','categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $uid=Auth::user()->email;
        $user=DB::table('shopowners')->where('email',$uid)->first();
        $menu_active=2;
        $plucked=Category_model::where('parent_id',0)->pluck('name','id');
        $cate_levels=['0'=>'Main Category']+$plucked->all();
        if($user==null)
        {
            return view('backEnd.category.create',compact('menu_active','cate_levels'));
        }
        else
        {
            return view('shopowner.category.create',compact('menu_active','cate_levels'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkCateName(Request $request){
        $data=$request->all();
        $category_name=$data['name'];
        $ch_cate_name_atDB=Category_model::select('name')->where('name',$category_name)->first();
        if($category_name==$ch_cate_name_atDB['name']){
            echo "true"; die();
        }else {
            echo "false"; die();
        }
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255|unique:categories,name',
            'url'=>'required',
        ]);
        $data=$request->all();
        Category_model::create($data);

        $uid=Auth::user()->email;
        $user=DB::table('shopowners')->where('email',$uid)->first();
        if($user==null)
        {
            $menu_active=0;
            $categories=Category_model::all();
            return view('backEnd.category.index',compact('menu_active','categories'));
        }
        else
        {
            $menu_active=0;
            $categories=Category_model::all();
            return view('shopowner.category.index',compact('menu_active','categories'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $uid=Auth::user()->email;
        $user=DB::table('shopowners')->where('email',$uid)->first();
        if($user==null)
        {
            $menu_active=0;
            $categories=Category_model::all();
            return view('backEnd.category.index',compact('menu_active','categories'));
        }
        else
        {
            $menu_active=0;
            $categories=Category_model::all();
            return view('shopowner.category.index',compact('menu_active','categories'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $uid=Auth::user()->email;
        $user=DB::table('shopowners')->where('email',$uid)->first();
        $menu_active=0;
        $plucked=Category_model::where('parent_id',0)->pluck('name','id');
        $cate_levels=['0'=>'Main Category']+$plucked->all();
        $edit_category=Category_model::findOrFail($id);
        if($user==null)
        {
            return view('backEnd.category.edit',compact('edit_category','menu_active','cate_levels'));
        }
        else
        {
            return view('shopowner.category.edit',compact('edit_category','menu_active','cate_levels'));
        }
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $cid=$request->id;
        $uid=Auth::user()->email;
        $user=DB::table('shopowners')->where('email',$uid)->first();
        
        $update_categories=Category_model::findOrFail($cid);
        $this->validate($request,[
            'name'=>'required|max:255|unique:categories,name,'.$update_categories->id,
            'url'=>'required',
        ]);
        //dd($request->all());die();
        $input_data=$request->all();
        if(empty($input_data['status'])){
            $input_data['status']=0;
        }
        $update_categories->update($input_data);
        if($user==null)
        {
            $menu_active=0;
            $categories=Category_model::all();
            return view('backEnd.category.index',compact('menu_active','categories'));
        }
        else
        {
            $menu_active=0;
            $categories=Category_model::all();
            return view('shopowner.category.index',compact('menu_active','categories'));
        }
    }





    public function supdate(Request $request)
    {
        $cid=$request->id;
        $uid=Auth::user()->email;
        $user=DB::table('shopowners')->where('email',$uid)->first();
        
        $update_categories=Category_model::findOrFail($cid);
        $this->validate($request,[
            'name'=>'required|max:255|unique:categories,name,'.$update_categories->id,
            'url'=>'required',
        ]);
        //dd($request->all());die();
        $input_data=$request->all();
        if(empty($input_data['status'])){
            $input_data['status']=0;
        }
        $update_categories->update($input_data);
        if($user==null)
        {
            
        }
        else
        {
            $menu_active=0;
            $categories=Category_model::all();
            return view('shopowner.category.index',compact('menu_active','categories'));
        }
    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=Category_model::findOrFail($id);
        $delete->delete();
        $menu_active=0;
        $categories=Category_model::all();
        $uid=Auth::user()->email;
        $user=DB::table('shopowners')->where('email',$uid)->first();
        if($user==null)
        {
            return view('backEnd.category.index',compact('menu_active','categories'))->with('message','Delete Success!');
        }
        else
        {
            return view('shopowner.category.index',compact('menu_active','categories'))->with('message','Delete Success!');
        }
        
        // return redirect()->route('category.index')->with('message','Delete Success!');
    }
}

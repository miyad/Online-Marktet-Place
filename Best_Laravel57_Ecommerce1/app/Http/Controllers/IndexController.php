<?php

namespace App\Http\Controllers;

use App\Category_model;
use App\Shop_model;
use App\ImageGallery_model;
use App\ProductAtrr_model;
use App\Products_model;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $products=Products_model::all();
        return view('frontEnd.index',compact('products'));
    }
    public function shop(){
        $products=Products_model::all();
        $byCate="";
        return view('frontEnd.products',compact('products','byCate'));
    }

    public function listByShop($id)
    {
        $products=Products_model::where('shop_id',$id)->get();
        $shop=Shop_model::where('id',$id)->first();
        return view('frontEnd.prodbyshop',compact('products','shop'));
    }

    public function listByCat($id){
        $list_product=Products_model::where('categories_id',$id)->get();

        $sub_categories=Category_model::where('parent_id',$id)->get();
        $entries=Products_model::where('categories_id','0')->get();
       foreach ($sub_categories as $i){
            $newentry = Products_model::where('categories_id',$i->id)->get();
            $entries = $entries->merge($newentry);
        }
                  
        
       // $p_list_product=Products_model::where('parent_id',$id)->get();

        $byCate=Category_model::select('name')->where('id',$id)->first();
        return view('frontEnd.products',compact('list_product','byCate','entries'));
    }
    public function detialpro($id){
        $detail_product=Products_model::findOrFail($id);
        $imagesGalleries=ImageGallery_model::where('products_id',$id)->get();
        $totalStock=ProductAtrr_model::where('products_id',$id)->sum('stock');
        $relateProducts=Products_model::where([['id','!=',$id],['categories_id',$detail_product->categories_id]])->get();
        return view('frontEnd.product_details',compact('detail_product','imagesGalleries','totalStock','relateProducts'));
    }
    public function getAttrs(Request $request){
        $all_attrs=$request->all();
        //print_r($all_attrs);die();
        $attr=explode('-',$all_attrs['size']);
        //echo $attr[0].' <=> '. $attr[1];
        $result_select=ProductAtrr_model::where(['products_id'=>$attr[0],'size'=>$attr[1]])->first();
        echo $result_select->price."#".$result_select->stock;
    }
    public function contact()
    {
        return view('frontEnd.contact');
    }
    public function search(Request $request){

        $req = $request->all();
        $byCate=Products_model::where('p_name', 'LIKE', '%'.$req['Search'].'%')->count();
        $list_product = Products_model::where('p_name', 'LIKE', '%'.$req['Search'].'%')->get();
        return view('frontEnd.search',compact('list_product','byCate'));
    }
}

@extends('frontEnd.layouts.master')
@section('title','List Products')
@section('slider')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('frontEnd.layouts.category_menu')
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <?php
                            if($byCate!=""){
                                $products=$list_product;
                                echo '<h2 class="title text-center">Category '.$byCate->name.'</h2>';
                            }else{
                                echo '<h2 class="title text-center">List Products</h2>';
                            }
                           
                    ?>
                    @foreach($products as $product)
                    <?php
                        $shop=DB::table('shops')->where('shopid',$product->shop_id)->first();
                    ?>    
                        @if($product->category->status==1)
                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{url('/product-detail',$product->id)}}"><img src="{{url('products/small/',$product->image)}}" alt="" /></a>
                                        <h2>BDT {{$product->price}}</h2>
                                        <p>{{$product->p_name}}</p>
                                        {{-- <p>{{$shop->bookedstatus==1?'Booked':'Not Booked'}}</p> --}}
                                        <a href="{{url('/product-detail',$product->id)}}" class="btn btn-default add-to-cart">View Product</a>
                                    </div>
                                </div>
                                <div class="choose">
                                    <i class="fa fa-shopping-basket"></i>Shop : 
                                        @if($product->shop_id==null)
                                            <i class="fa fa-star"></i>AdminShop
                                        @else
                                        <?php
                                        $shop=DB::table('shops')->where('id',$product->shop_id)->first();
                                        ?>
                                        <i class="fa fa-adjust"></i> {{$shop->shop_name}}
                                        @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach

                    @foreach($entries as $product)
                        @if($product->category->status==1)
                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{url('/product-detail',$product->id)}}"><img src="{{url('products/small/',$product->image)}}" alt="" /></a>
                                        <h2>BDT {{$product->price}}</h2>
                                        <p>{{$product->p_name}}</p>
                                        <a href="{{url('/product-detail',$product->id)}}" class="btn btn-default add-to-cart">View Product</a>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <i class="fa fa-shopping-basket"></i>Shop : 
                                        @if($product->shop_id==null)
                                            <i class="fa fa-star"></i>AdminShop
                                        @else
                                        <?php
                                        $shop=DB::table('shops')->where('id',$product->shop_id)->first();
                                        ?>
                                        <i class="fa fa-adjust"></i> {{$shop->shop_name}}
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach



                    {{--<ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                    </ul>--}}
                </div><!--features_items-->
            </div>
        </div>
    </div>
@endsection
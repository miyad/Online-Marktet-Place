@extends('frontEnd.layouts.master')
@section('title','Detial Page')
@section('slider')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('frontEnd.layouts.category_menu')
            @include('frontEnd.layouts.shop_menu')
        </div>
        <div class="col-sm-9 padding-right">
            @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                {{Session::get('message')}}
            </div>
            @endif
            <div class="product-details">
                <!--product-details-->

                <div class="col-sm-5">
                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                        <a href="{{url('products/large',$detail_product->image)}}">
                            <img src="{{url('products/small',$detail_product->image)}}" alt="" id="dynamicImage" />
                        </a>
                    </div>

                    <ul class="thumbnails" style="margin-left: -10px;">
                        <li>
                            @foreach($imagesGalleries as $imagesGallery)
                            <a href="{{url('products/large',$imagesGallery->image)}}"
                                data-standard="{{url('products/small',$imagesGallery->image)}}">
                                <img src="{{url('products/small',$imagesGallery->image)}}" alt="" width="75"
                                    style="padding: 8px;">
                            </a>
                            @endforeach
                        </li>
                    </ul>
                </div>
                <div class="col-sm-7">
                    <form action="{{route('addToCart')}}" method="post" role="form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="products_id" value="{{$detail_product->id}}">
                        <input type="hidden" name="product_name" value="{{$detail_product->p_name}}">
                        <input type="hidden" name="product_code" value="{{$detail_product->p_code}}">
                        <input type="hidden" name="product_color" value="{{$detail_product->p_color}}">
                        <input type="hidden" name="price" value="{{$detail_product->price}}" id="dynamicPriceInput">
                        <div class="product-information">
                            <!--/product-information-->
                            <img src="{{asset('frontEnd/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                            <h2>{{$detail_product->p_name}}</h2>
                            <p>Code ID: {{$detail_product->p_code}}</p>
                            <span>
                                <select name="size" id="idSize" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($detail_product->attributes as $attrs)
                                    <option value="{{$detail_product->id}}-{{$attrs->size}}">{{$attrs->size}}</option>
                                    @endforeach
                                </select>
                            </span><br>
                            <span>
                                <span id="dynamic_price">BDT {{$detail_product->price}}</span>
                                <label>Quantity:</label>
                                <input type="text" name="quantity" value="{{$totalStock}}" id="inputStock" />
                                @if($totalStock>0)
                                <button type="submit" class="btn btn-fefault cart" id="buttonAddToCart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                                @endif
                            </span>
                            <p><b>Availability:</b>
                                @if($totalStock>0)
                                <span id="availableStock">In Stock</span>
                                @else
                                <span id="availableStock">Out of Stock</span>
                                @endif
                            </p>
                            <p><b>Condition:</b> New</p>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <i class="fa fa-shopping-basket"></i>Shop : 
                                    @if($detail_product->shop_id==null)
                                        <i class="fa fa-star"></i>AdminShop
                                    @else
                                    <?php
                                    $shop=DB::table('shops')->where('id',$detail_product->shop_id)->first();
                                    ?>
                                    <i class="fa fa-adjust"></i> {{$shop->shop_name}}
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!--/product-information-->
                    </form>

                </div>
            </div>
            <!--/product-details-->

            <div class="category-tab shop-details-tab">
                <!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                        
                        <li><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="details">
                        {{$detail_product->description}}
                    </div>

                    <div class="tab-pane fade" id="companyprofile">
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('frontEnd/images/home/gallery1.jpg')}}" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('frontEnd/images/home/gallery3.jpg')}}" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('frontEnd/images/home/gallery2.jpg')}}" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('frontEnd/images/home/gallery4.jpg')}}" alt="" />
                                        <h2>$56</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <button type="button" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="reviews">

                        <div class="col-sm-12">


                            <form action="{{url('/prodreview')}}" method="post">
                                <span>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="productid" id="productid"
                                        value="{{$detail_product->id}}">
                                    <input type="text" name="name" id="name" placeholder="Your Name" />
                                    <!-- <input type="email" name="email" id="email" placeholder="Email Address"/> -->
                                </span>
                                <span><input type="text" name="email" id="email" placeholder="Email Address" /></span>
                                <textarea name="description" name="description" id="description"
                                    placeholder="description here"></textarea>
                                <b>Rating: </b> <input type="number" min="1" max="5" name="rating" id="rating"
                                    placeholder="Rating please 1 to 5" />
                                <button type="submit" value="prodreview" name="prodreview"
                                    class="btn btn-default pull-right">
                                    Submit
                                </button>
                            </form>
                        </div>
                        <br><br><br><h5>Reviews</h5>
                        <?php
                        $reviews_prod=DB::table('reviews')->select('*')->where('productid',$detail_product->id)->get();
                        $i=0;
                        ?>

                        @foreach($reviews_prod as $review)
                        <?php
                        $i=$i+1;
                        ?>
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>{{$review->name}}</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>{{$review->created_at}}</a></li>
                        </ul>
                        <p><b>Rating : {{$review->rating}}</b></p><br>
                        <p>{{$review->description}}</p>
                    </div>
                    @endforeach
                    @if($i==0)
                        <b>NO Reviews</b>
                    @endif



                </div>
            </div>
            <!--/category-tab-->

            <div class="recommended_items">
                <!--recommended_items-->
                <h2 class="title text-center">recommended items</h2>

                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $countChunk=0;?>
                        @foreach($relateProducts->chunk(3) as $chunk)
                        <?php $countChunk++; ?>
                        <div class="item<?php if($countChunk==1){ echo' active';} ?>">
                            @foreach($chunk as $item)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{url('/products/small',$item->image)}}" alt=""
                                                style="width: 150px;" />
                                            <h2>{{$item->price}}</h2>
                                            <p>{{$item->p_name}}</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <!--/recommended_items-->

        </div>
    </div>
</div>
@endsection
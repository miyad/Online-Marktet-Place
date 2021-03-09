
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> 01517078796</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> nazmulhasnsakib@gmail.com</a></li>

                        </ul>
                        <ul class="nav nav-pills">
                            <?php 
                    $date_now=date('Y-m-d');
                    $coupons=DB::table('coupons')->get();
                    $valid=null;
                    foreach ($coupons as $coupon) {
                        if($coupon->expiry_date>$date_now)
                        {
                            $valid=$coupon;
                        }
                    }
                    if($valid!=null)
                    {
                         echo '<li><a href="#"><i class="fa fa-apple"></i> Use Coupon to get offer: '.$valid->coupon_code.'</a></li>';
                    }
                    ?>
                        </ul>
                    </div>
                </div>
                <?php 
                    $date_now=date('Y-m-d');
                    $coupons=DB::table('coupons')->get();
                    $valid=null;
                    foreach ($coupons as $coupon) {
                        if($coupon->expiry_date>$date_now)
                        {
                            $valid=$coupon;
                        }
                    }
                    if($valid!=null)
                    {
                        // echo '<h1 class="title text-center">Use Coupon to get offer : '.$valid->coupon_code.'</h1>';
                    }
                    ?>
                {{-- <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="logo pull-right"> 
                        <a href="{{url('/')}}"><img src="{{asset('frontEnd/images/home/bestlogo.png')}}" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                                <?php 
                                    use Illuminate\Support\Facades\Session;
                                    use Illuminate\Support\Facades\Auth;
                                    use App\Cart_model;
                                    $session_id=Session::get('session_id');
                                    
                                    if(Auth::user()==null)
                                    {
                                        $mail='nazmulhasnsakib@gmail.com';
                                    }
                                    else
                                    {
                                        $mail=Auth::user()->email;
                                    }
                                    $cart_count=Cart_model::where('user_email',$mail)->count();
                                 ?>
                            @if($cart_count>0)
                            <li><a href="{{url('/viewcart')}}"><span class="fa fa-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"><font color="red">{{$cart_count}}</font></span></span> Cart</a></li>
                            @else
                            <li><a href="{{url('/viewcart')}}"><span class="fa fa-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"><font color="white">{{$cart_count}}</font></span></span> Cart</a></li>
                        
                            @endif

                            @if(Auth::check())
                                <li><a href="{{url('/myaccount')}}"><i class="fa fa-user"></i> My Account</a></li>
                                <li><a href="{{url('/prev_orders')}}" ><i class="fa fa-history"></i> Previous Orders</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-lock"></i> Logout </a>
                                
                                </li>
                            @else
                                <li><a href="{{url('/login_page')}}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            
                            <li><a href="{{url('/')}}" class="hyper"><span>Home</span></a></li>
                            <li class="dropdown"><a href="#"class="dropdown-toggle hyper" data-toggle="dropdown"><span>Shop<b class="caret"></b></span></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{url('/list-products')}}">Products</a></li>
                                    <li><a href="{{url('/myaccount')}}">Account</a></li>
                                    <li><a href="{{url('/viewcart')}}">Cart</a></li>
                                </ul>
                            </li>     
                            <li>
                                <a href="{{url('/viewavailableshops')}}" class="hyper"> <span>Rent a Shop</span></a>
                            </li>
                            <li><a href="{{url('/contact')}}" class="hyper" target="_blank"><span>Contact Us</span></a></li>
                        </ul>
                    </div>
                    {{-- <div class="search-form" align="right">
                    <form action="{{url('/search')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="text" placeholder="Search..." name="Search" id="Search">
                        <input type="submit" value="Search">
                    </form>
                </div> --}}
                    
                    
                    <form class="form-inline" align="right" action="{{url('/search')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                          <div class="input-group"><br>
                            <input type="text" class="form-control" placeholder="Search..." name="Search" id="Search">
                            {{-- <div class="input-group-addon">Q</div> --}}
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                      </form>
                    

                
                {{-- <div class="container">
                        <br/>
                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-10 col-lg-8">
                                                <form class="card card-sm">
                                                    <div class="card-body row no-gutters align-items-center">
                                                        <!--end of col-->
                                                        <div class="col">
                                                                <input class="form-control" type="text" name="Search" placeholder="Search product or catagory">
                                                        </div>
                                                        <!--end of col-->
                                                        <div class="col-auto">
                                                            <button class="btn btn-lg btn-success" type="submit">Search</button>
                                                        </div>
                                                        <!--end of col-->
                                                    </div>
                                                </form>
                                            </div>
                                            <!--end of col-->
                                        </div>
                    </div> --}}
                        

                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

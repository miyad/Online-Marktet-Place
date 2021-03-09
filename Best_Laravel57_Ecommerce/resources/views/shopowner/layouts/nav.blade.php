<!--sidebar-menu-->
<div id="sidebar"><a href="{{url('/shopowner')}}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        
        <li{{$menu_active==1? ' class=active':''}}><a href="{{url('/shopowner')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        
        <li class="submenu {{$menu_active==2? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span></a>
            <ul>
                <li><a href="{{url('/shopowner/category/create')}}">Add New Category</a></li>
                <li><a href="{{route('category.index')}}">List Categories</a></li>
            </ul>
        </li>
        <li class="submenu {{$menu_active==3? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span></a>
            <ul>
                <li><a href="{{url('/shopowner/product/create')}}">Add New Products</a></li>
                <li><a href="{{route('product.index')}}">List Products</a></li>
            </ul>
        </li>
        {{-- <li class="submenu {{$menu_active==4? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span></a>
            <ul>
                <li><a href="{{route('coupon.create')}}">Add New Coupon</a></li>
                <li><a href="{{route('coupon.index')}}">List Coupons</a></li>
            </ul>
        </li> 
        <li class="submenu {{$menu_active==5? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Shops</span></a>
            <ul>
                <li><a href="{{route('shop.create')}}">Add New Shop</a></li>
                <li><a href="{{route('shop.index')}}">List Shops</a></li>
            </ul>
        </li> 
        <li class="submenu {{$menu_active==6? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Applications</span></a>
            <ul>
                <li><a href="{{url('/showapplications0')}}">Show Applications</a></li>
                <li><a href="{{url('/showapplications1')}}">Approve & Give Shop</a></li>
            </ul>
        </li> 
        <li class="submenu {{$menu_active==7? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span></a>
            <ul>
                <li><a href="{{url('/shopowner/orders/show')}}">Show Orders</a></li>
                <!-- <li><a href="{{route('orders.index')}}">List Shops</a></li> -->
            </ul>
        </li> --}}
    </ul>
</div>
<!--sidebar-menu-->
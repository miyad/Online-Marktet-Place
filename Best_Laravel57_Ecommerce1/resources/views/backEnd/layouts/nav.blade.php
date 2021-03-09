<!--sidebar-menu-->
<div id="sidebar"><a href="{{url('/admin')}}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        
        <li{{$menu_active==1? ' class=active':''}}><a href="{{url('/admin')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        
        <li class="submenu {{$menu_active==2? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span></a>
            <ul>
                <li><a href="{{url('/admin/category/create')}}">Add New Category</a></li>
                <li><a href="{{url('/admin/category/index')}}">List Categories</a></li>
            </ul>
        </li>
        <li class="submenu {{$menu_active==3? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span></a>
            <ul>
                <li><a href="{{url('/admin/product/create')}}">Add New Products</a></li>
                <li><a href="{{url('/admin/product/index')}}">List Products</a></li>
            </ul>
        </li>
        <li class="submenu {{$menu_active==4? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span></a>
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
                <li><a href="{{url('/admin/showapplications0')}}">Show Applications</a></li>
                <li><a href="{{url('/admin/showapplications1')}}">Approve & Give Shop</a></li>
            </ul>
        </li>
        <li class="submenu {{$menu_active==7? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span></a>
            <ul>
                <li><a href="{{url('/admin/orders/show',1)}}">Show Pending Orders</a></li>
                <li><a href="{{url('/admin/orders/show',2)}}">Show assigned Orders</a></li>
                <li><a href="{{url('/admin/orders/show',3)}}">Show completed Orders</a></li>
            </ul>
        </li>
        <li class="submenu {{$menu_active==8? ' active':''}}"> <a href="#"><i class="icon icon-th-list"></i> <span>Delivery Man</span></a>
            <ul>
                <li><a href="{{url('/admin/addNewDM')}}">Add New Delivery Man</a></li>
                <li><a href="{{url('/admin/showDeliveryMan')}}">List Delivery Man</a></li>
            </ul>
        </li>
    </ul>
</div>
<!--sidebar-menu-->
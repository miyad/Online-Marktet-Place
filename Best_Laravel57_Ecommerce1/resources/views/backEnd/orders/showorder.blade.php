@extends('backEnd.layouts.master')
@section('title','List Orders')
@section('content')
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{url('/admin/orders/show')}}" class="current">Orders</a></div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>List Orders</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile no</th>
                        <th>Status</th>
                        <th>Payment method</th>
                        {{-- <th>Delivery</th> --}}
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; ?>
                    @foreach($orders as $order)
                        <?php 
                            $orderedprods=DB::table('orderedproduct')->where('order_id',$order->id)->get();   
                           $delman=DB::table('deliveryman')->where('id',$order->deliveryman_id)->first();                                                               
                        ?>
                        <tr class="gradeC">

                            <td style="vertical-align: middle;">{{$order->users_id}}</td>
                            <td style="vertical-align: middle;">{{$order->id}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$order->name}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$order->users_email}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$order->mobile}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$order->order_status}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$order->payment_method}}</td>
                            

                                @if($id==1)
                                    <td style="text-align: center; vertical-align: middle;">
                                    <a href="{{url('/admin/orders/assign',$order->id)}}" class="btn btn-primary btn-mini">Accept</a>
                                @elseif($id==2)
                                    <td style="text-align: center; vertical-align: middle;">
                                    <a href="{{url('/admin/orders/complete',$order->id)}}" class="btn btn-primary btn-mini">Complete</a>
                                @else
                                    <td style="text-align: center; vertical-align: middle;">
                                @endif

                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Show Products</button>
                                <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Ordered Product
                                              </h4>
                                              
                                            </div>
                                            <div class="modal-body">
                                            
                                            
                                            <table class="table table-bordered ">
                                                    <thead>
                                                            <tr> 
                                                                    <th>Deliveryman : {{$id==1?'Not assigned':$delman->name}}</th>
                                                                    <th>Contact     : {{$id==1?'---':$delman->mobile}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Product ID</th>
                                                                <th>Product Name</th>
                                                                <th>Shop Name</th>
                                                                <th>Color</th>
                                                                <th>Size</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                            </tr>
                                                            </thead>
                                                <tbody>
                                                    @foreach($orderedprods as $orderedprod)
                                                    <?php 
                                                        $prod=DB::table('products')->where('id',$orderedprod->products_id)->first();
                                                        $shop=DB::table('shops')->where('id',$prod->shop_id)->first();                                                               
                                                    ?>
                                                    <tr>
                                                            <td style="vertical-align: middle;">{{$orderedprod->products_id}}</td>
                                                            <td style="vertical-align: middle;">{{$orderedprod->product_name}}</td>
                                                            <td style="vertical-align: middle;">{{$shop->shop_name}}</td>
                                                            <td style="vertical-align: middle;">{{$orderedprod->product_color}}</td>
                                                            <td style="vertical-align: middle;">{{$orderedprod->size}}</td>
                                                            <td style="vertical-align: middle;">{{$orderedprod->price}}</td>
                                                            <td style="vertical-align: middle;">{{$orderedprod->quantity}}</td>
                                                    </tr>
                                                     @endforeach
                                                </tbody>
                                               
                                            </table>  
                                            
                                            
                                        </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>

                                <a href="javascript:" rel="{{$order->id}}" rel1="delete-order" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('jsblock')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.tables.js')}}"></script>
    <script src="{{asset('js/matrix.popover.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(".deleteRecord").click(function () {
            var id=$(this).attr('rel');
            var deleteFunction=$(this).attr('rel1');
            swal({
                title:'Are you sure?',
                text:"You won't be able to revert this!",
                type:'warning',
                showCancelButton:true,
                confirmButtonColor:'#3085d6',
                cancelButtonColor:'#d33',
                confirmButtonText:'Yes, delete it!',
                cancelButtonText:'No, cancel!',
                confirmButtonClass:'btn btn-success',
                cancelButtonClass:'btn btn-danger',
                buttonsStyling:false,
                reverseButtons:true
            },function () {
                window.location.href="/admin/"+deleteFunction+"/"+id;
            });
        });
    </script>
@endsection
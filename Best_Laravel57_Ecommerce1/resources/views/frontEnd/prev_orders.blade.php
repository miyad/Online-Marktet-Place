@extends('frontEnd.layouts.master')
@section('title','Cart Page')
@section('slider')
@endsection
@section('content')
    <section id="cart_items">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-success text-center" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="number">Order No.</td>

                        <td class="price">Grand Total</td>
                        <td class="date">Order Date</td>
                        <td class="total">Status</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <?php 
                            $orderedprods=DB::table('orderedproduct')->where('order_id',$order->id)->get();
                            $delman=DB::table('deliveryman')->where('id',$order->deliveryman_id)->first();
                        ?>
                            <tr>
                            <tr class="gradeC">
                            
                            <td style="vertical-align: middle;">{{$order->id}}</td>
                            <td style="vertical-align: middle;">{{$order->grand_total}}</td>
                            <td style=" vertical-align: middle;">{{$order->created_at}} </td>
                            <td style=" vertical-align: middle;">{{$order->order_status}}</td>
                            <td style=" vertical-align: middle;">
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
                                                                    <th>Deliveryman : {{$order->order_status=="pending"?'Not assigned':$delman->name}}</th>
                                                                    <th>Contact     : {{$order->order_status=="pending"?'---':$delman->mobile}}</th>
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
                                    </td>
                        </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
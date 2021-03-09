<!DOCTYPE html>
<html>
<head>
	<title>Order Details</title>
    
     {{-- <link href="{{asset('frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/form.css')}}" rel="stylesheet">  --}}
</head>
<body>
	<h1>Dear {{$name}}, Your order has been Placed</h1>
    <h2>Order Sl no :{{$order_id}}</h2>
    <br>
    <br>
    <h2>Delivery Details :</h2>
    <p>
    Address : {{$address}}<br>
    City : {{$city}}<br>
    Division : {{$state}}, Bangladesh<br>
    PO code : {{$pincode}}<br>
    Contact : {{$mobile}}<br>

    </p>
    <br>
    <br>

    <h2>Order Details :</h2>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        
                        <td class="name">Name</td>
                        <td class="number">Product Code</td>
                        <td class="quantity">Quantity</td>
                        <td class="price">Price</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                          $products=DB::table('orderedproduct')->select('*')->
                           where('order_id',$order_id)->get();
                     ?>

                           
                         @foreach($products as $product)
                          
                          <?php
                             
                           ?>
                           <tr>
                                <td class="name">
                                   <p>{{$product->product_name}}</p>
                                </td>
                                <td class="number">
                                    <p>{{$product->product_code}}</p>
                                </td>
                                <td class="quantity">
                                    <p>BDT {{$product->quantity}}</p>
                                </td>
                                <td class="price">
                                    <p>BDT {{$product->price}}</p>
                                </td>
                           
                           
                            </tr>

                         
                         @endforeach

                    </tbody>

    <\div>


     <br>
     <br>

                            <h3>Grand Total : BDT {{$grand_total+$shipping_charges}}</h3>
                            <h3>shipping charge : BDT {{$shipping_charges}}</h3>
                            <h3>Coupons : {{$coupon_code}}</h3>
                            <h3>Discount : {{$coupon_amount}}</h3>
                            <h3>Total : BDT {{$coupon_amount+$grand_total}}</h3>
                            

	
</body>
</html>

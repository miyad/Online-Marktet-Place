@extends('backEnd.layouts.master')
@section('title','Edit Shop Page')
@section('content')
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('shop.index')}}">shops</a> <a href="#" class="current">Edit Shop</a> </div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done! &nbsp;</strong>{{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Add New Shop</h5>
            </div>
            <div class="widget-content nopadding">
                <form action="{{route('shop.update',$edit_shop->id)}}" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    {{method_field("PUT")}}
                    <div class="control-group">
                        <label for="shopid" class="control-label">Shop id </label>
                        <div class="controls{{$errors->has('shopid')?' has-error':''}}">
                            <input type="number" name="shopid" id="shopid" class="form-control" value="{{$edit_shop->shopid}}"
                                   title="" required="required"  style="width: 400px;">
                            <span class="text-danger">{{$errors->first('shopid')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="shop_name" class="control-label">shop_name</label>
                        <div class="controls{{$errors->has('shop_name')?' has-error':''}}">
                            <input type="text" name="shop_name" id="shop_name" class="form-control" value="{{$edit_shop->shop_name}}" title="" required="required" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('shop_name')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="price" class="control-label">Shop price </label>
                        <div class="controls{{$errors->has('price')?' has-error':''}}">
                            <input type="number" name="price" id="shopid" class="form-control" value="{{$edit_shop->price}}"
                                   title="" required="required"  style="width: 400px;">
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="isrent" class="control-label">Rent status </label>
                        <div class="controls{{$errors->has('isrent')?' has-error':''}}">
                            <input type="number" name="isrent" id="isrent" class="form-control" value="{{$edit_shop->isrent}}"
                                   title="" required="required"  style="width: 400px;">
                            <span class="text-danger">{{$errors->first('isrent')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="bookedstatus" class="control-label">Booked status </label>
                        <div class="controls{{$errors->has('bookedstatus')?' has-error':''}}">
                            <input type="number" name="bookedstatus" id="bookedstatus" class="form-control" value="{{$edit_shop->bookedstatus}}"
                                   title="" required="required"  style="width: 400px;">
                            <span class="text-danger">{{$errors->first('bookedstatus')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="" class="control-label"></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-success">Update Shop</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('jsblock')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/jquery.toggle.buttons.js')}}"></script>
    <script src="{{asset('js/masked.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.form_common.js')}}"></script>
    <script src="{{asset('js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-wysihtml5.js')}}"></script>
    <script>
        $('.textarea_editor').wysihtml5();
    </script>
@endsection
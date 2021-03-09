@extends('backEnd.layouts.master')
@section('title','Add Shops Page')
@section('content')
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('shop.index')}}">Shops</a> <a href="{{route('shop.create')}}" class="current">Add New shop</a> </div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done! &nbsp;</strong>{{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Add New shop</h5>
            </div>
            <div class="widget-content nopadding">
                <form action="{{route('shop.store')}}" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="control-group">
                        <label for="shopid" class="control-label">shop id</label>
                        <div class="controls{{$errors->has('shopid')?' has-error':''}}">
                            <input type="number" min="100" name="shopid" id="shopid" class="form-control" value="{{old('shopid')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('shopid')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="shop_name" class="control-label">Shop Name</label>
                        <div class="controls{{$errors->has('shop_name')?' has-error':''}}">
                            <input type="text"  name="shop_name" id="shop_name" class="form-control" value="{{old('shop_name')}}" title="" required="required" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('shop_name')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="area" class="control-label">shop area</label>
                        <div class="controls{{$errors->has('area')?' has-error':''}}">
                            <input type="number" min="1000" name="area" id="area" class="form-control" value="{{old('area')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('area')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="price" class="control-label">shop price</label>
                        <div class="controls{{$errors->has('price')?' has-error':''}}">
                            <input type="number" min="1000" name="price" id="price" class="form-control" value="{{old('price')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="floor" class="control-label">floor</label>
                        <div class="controls{{$errors->has('floor')?' has-error':''}}">
                            <input type="number" min="1" name="floor" id="floor" class="form-control" value="{{old('floor')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('floor')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="" class="control-label"></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-success">Add New shop</button>
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
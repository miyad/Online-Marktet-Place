@extends('backEnd.layouts.master')
@section('title','Add Deliveryman Page')
@section('content')
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{url('/admin/showDeliveryMan')}}">Deliveryman</a> <a href="{{url('admin/addNewDM')}}" class="current">Add New Deliveryman</a> </div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done! &nbsp;</strong>{{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Add New Deliveryman</h5>
            </div>
            <div class="widget-content nopadding">
                <form action="{{url('/admin/storeNewDM')}}" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="control-group">
                        <label for="name" class="control-label">Name</label>
                        <div class="controls{{$errors->has('name')?' has-error':''}}">
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="email" class="control-label">Email</label>
                        <div class="controls{{$errors->has('email')?' has-error':''}}">
                            <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" title="" required="" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="isavailable" class="control-label">Isavailable</label>
                        <div class="controls{{$errors->has('isavailable')?' has-error':''}}">
                            <input type="number" min="0" max="1" name="isavailable" id="isavailable" class="form-control" value="{{old('isavailable')}}" title="" required="required" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('isavailable')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="mobile" class="control-label">Mobile</label>
                        <div class="controls{{$errors->has('mobile')?' has-error':''}}">
                            <input type="number" min="0" name="mobile" id="mobile" class="form-control" value="{{old('mobile')}}" title="" required="required" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('mobile')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="" class="control-label"></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-success">Add New Coupon</button>
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
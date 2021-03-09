@extends('frontEnd.layouts.master')
@section('title','Add Shops Page')
@section('content')
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done! &nbsp;</strong>{{Session::get('message')}}
            </div>
        @endif

        {{-- <div class="widget-box"> --}}
            <div class="row">
            <div class="col-sm-12">
            <div class="container">
                {{-- <div class="main-agileits">
                    <div class="form-w3agile form1">
                        <div class="widget-content nopadding"> --}}
                <h5>Information</h5>
                <form action="{{route('application.store')}}" method="post" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="shopid" id="shopid" value="{{$id}}">
                     <div class="control-group">
                        <label for="name" class="control-label">Name</label>
                        <div class="controls{{$errors->has('name')?' has-error':''}}">
                            <input type="text"  name="name" id="name" class="form-control" value="{{old('name')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="email" class="control-label"> Email</label>
                        <div class="controls{{$errors->has('email')?' has-error':''}}">
                            <input type="email"  name="email" id="email" class="form-control" value="{{old('email')}}" title="" required="required" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="address" class="control-label"> address</label>
                        <div class="controls{{$errors->has('address')?' has-error':''}}">
                            <input type="text"  name="address" id="address" class="form-control" value="{{old('address')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('address')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="city" class="control-label"> city</label>
                        <div class="controls{{$errors->has('city')?' has-error':''}}">
                            <input type="text"  name="city" id="city" class="form-control" value="{{old('city')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('city')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="country" class="control-label"> country</label>
                        <div class="controls{{$errors->has('country')?' has-error':''}}">
                            <input type="text"  name="country" id="country" class="form-control" value="{{old('country')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('country')}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="mobile" class="control-label"> mobile</label>
                        <div class="controls{{$errors->has('mobile')?' has-error':''}}">
                            <input type="number" name="mobile" id="mobile" class="form-control" value="{{old('mobile')}}"
                                   title="" required="required" minlength="5" maxlength="15" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('mobile')}}</span>
                        </div>
                    </div> 

                    <div class="control-group">
                        <label for="" class="control-label"></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-success">Confirm</button>
                        </div>
                     </div>
                </div>
            {{--</div> --}}
        {{-- </div> --}}
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
    <script>
        $("input").intlTelInput({
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
        });
    </script>
@endsection













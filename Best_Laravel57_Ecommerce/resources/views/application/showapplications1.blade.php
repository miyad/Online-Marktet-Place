@extends('backEnd.layouts.master')
@section('title','List applications')
@section('content')
<div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{url('/showapplications1')}}" class="current">showapplications</a></div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>List Products</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Shop's serial</th>
                        <th>Email</th>
                        <th>Adress</th>
                        <th>City</th>
                        <th>Mobile No</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; ?>
                    @foreach($applications as $application)
                        <?php $i++; ?>
                        <tr class="gradeD">
                            <td>{{$i}}</td>
                            <td style="vertical-align: center;">{{$application->name}}</td>
                            <td style="vertical-align: center;">{{$application->shopid}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$application->email}} </td>
                            <td style="vertical-align: center;">{{$application->address}}</td>
                            <td style="text-align: center; vertical-align: center;">{{$application->city}} </td>
                            <td style="text-align: center; vertical-align: center;">{{$application->mobile}}</td>
                            <td style="text-align: center; vertical-align: center;">
                            <a href="{{url('/giveShop',$application->id)}}" class="btn btn-primary btn-mini">Assign Shop</a>
                            <a href="{{url('/deleteApplication',$application->id,1)}}" class="btn btn-danger btn-mini deleteRecord">Ignore</a>
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
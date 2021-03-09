@extends('backEnd.layouts.master')
@section('title','List applications')
@section('content')

    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{url('/showapplications0')}}" class="current">showapplications</a></div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>List Applications</h5>
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
                        <tr class="gradeC">
                            <td>{{$i}}</td>
                            <td style="vertical-align: center;">{{$application->name}}</td>
                            <td style="vertical-align: center;">{{$application->shopid}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$application->email}} </td>
                            <td style="vertical-align: center;">{{$application->address}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{$application->city}} </td>
                            <td style="text-align: center; vertical-align: middle;">{{$application->mobile}}</td>
                            
                            
                                <td style="text-align: center; vertical-align: middle;">
                                <a href="{{url('/admin/application/givetime',$application->id)}}" class="btn btn-primary btn-mini">Give Appointment</a>
                                <a href="javascript:" rel="{{$application->id}}" rel1="deleteApplication0" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                {{-- <a href="{{url('/admin/deleteApplication/'.$application->id.'/'.'0')}}" class="btn btn-primary btn-mini">Ignore</a> --}}
                                
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
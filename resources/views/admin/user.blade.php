@extends('admin.template')
@section('header')
    <link href="/public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="/public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User Management</h1>
           <a href="{{url('admin/user/create')}}" class="btn btn-primary create_new pull-right" role="button">Create New User</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All posts
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                       <table class="table table-striped table-bordered table-hover" id="datatable_example">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Stt</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Birthday</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users))
                                <?php $i = 0; ?>
                                @foreach($users as $user)
                                <?php $i++; ?>
                                <tr>
                                    <td><input type="checkbox" ></td>
                                    <td>{{$i}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->birthday}}</td>
                                    <td>{{$user->address}}</td>
                                    <td class="center" style="width:150px;">
                                        <a href="{{url('admin/user/edit/')}}/{{$user->id}}" class="icon-action"><img src="{{asset('public/images/edit.png')}}"> Edit |</a>
                                        <a href="{{url('admin/user/delete/')}}/{{$user->id}}" class="icon-action"><img src="{{asset('public/images/delete.png')}}"> Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary">Delete selected</button>
        </div>
    </div>
    <style type="text/css">
        .icon-action img{
            width: 20px;
            height: 20px;
        }
        .icon-action:hover{
            text-decoration: none;
        }
    </style>
@endsection
@section('script')
    <script src="/public/admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable_example').DataTable({
                    responsive: true,
                    // default ordering
                    order: [[ 1, "asc" ]],
                    // select ordering and search
                    aoColumnDefs: [{
                        bSortable: false,
                        bSearchable: false,
                        // select column to disable. add (-) from right to left
                        aTargets: [ -1, 0]
                    }]
            });
        });
    </script>
@endsection
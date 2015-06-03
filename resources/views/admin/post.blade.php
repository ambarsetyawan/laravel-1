@extends('admin.template')
@section('header')
    <link href="/public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="/public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Post Management</h1>
           <a href="{{url('admin/post/create')}}" class="btn btn-primary create_new pull-right" role="button">Create New Post</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="panel-heading">
                    All posts
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                       <table class="table table-striped table-bordered table-hover" id="datatable_example">
                            <thead>
                                <tr>
                                    <th class="center"><input type="checkbox" id="check_all"></th>
                                    <th width="30px">Stt</th>
                                    <th>Title</th>
                                    <th width="100px">Category</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th width="100px">Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($posts))
                                <?php $i = 0; ?>
                                @foreach($posts as $post)
                                <?php $i++; ?>
                                <tr id="tr_{{$post->id}}">
                                    <td class="center"><input type="checkbox" id="delete_{{$post->id}}"></td>
                                    <td>{{$i}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->category_name}}</td>
                                    <td>{{$post->content}}</td>
                                    <td>
                                        @if($post->image != "")
                                        <img src="{{asset('public/images/post')}}/{{$post->image}}" style="width: 100px; height=100px;">
                                        @endif
                                    </td>
                                    <td>{{date('d-m-Y', strtotime($post->created_at))}}</td>
                                    <td class="center" style="width:150px;">
                                        <a href="{{url('admin/post/edit/')}}/{{$post->id}}" class="icon-action"><img src="{{asset('public/images/edit.png')}}"> Edit |</a>
                                        <a href="{{url('admin/post/delete/')}}/{{$post->id}}" class="icon-action"><img src="{{asset('public/images/delete.png')}}"> Delete</a>
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
            <button class="btn btn-primary" id="deleteAll">Delete selected</button>
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
                    bInfo : false,
                    // aLengthMenu: [[5, 20, 40, -1], [5, 20, 40, "All"]],
                    // iDisplayLength: 5,
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
            $("#check_all").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
            $('#deleteAll').click(function(){
                var ids = [];
                $("[id^=delete_]").each(function() {
                    if ($(this).is(":checked")) {
                        id = $(this).attr("id");
                        id = id.substr(id.indexOf("_") + 1);
                        ids.push(id);
                    }
                });
                if(ids){
                    $.ajax({
                        headers: {
                            'X-XSRF-TOKEN': $('input[name="_token"]').val()
                        },
                        type: "DELETE",
                        url : "/admin/post/delete",
                        data : {ids: ids, _token: $('input[name="_token"]').val()},
                        dataType : "JSON",
                        success : function(data){
                            if(data == 200){
                                for(i = 0; i < ids.length; i++){
                                    $('#tr_'+ids[i]).hide();
                                }
                                alert('Delete Sucess!');
                            }
                            else {
                                console.log(data);
                                alert("Error! Please try again!");
                            }
                        },
                        error: function(data) {
                            alert("Error! Please try again!");
                        },
                    });
                }
            });
        });
    </script>
@endsection
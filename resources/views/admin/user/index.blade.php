@extends('admin')

@section('head')
	@parent
	<link rel="stylesheet" href="{{asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('header-title')
	<section class="content-header">
      <h1>
        User maganent
        <small>Users List</small>
      </h1>
    </section>
@endsection

@section('content')
	<div class="box">
        <div class="box-header">
          <h3 class="box-title">Users List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Platform(s)</th>
              <th>Action</th>
              <th>Note</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
            <tr>
              <td><a href="{{route('users.show',['id'=>$user->id])}}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>Win 95+</td>
              <td>
              	<a href="{{route('users.edit',['id'=>$user->id])}}" role="button" class="btn btn-primary">Edit</a>
              	<a>
		          	{{ Form::open(['method'=>'DELETE', 'route'=>['users.destroy', $user->id]]) }}
					{{ Form::submit('Delete', ['class'=>'btn btn-danger']) }}
					{{ Form::close() }}
				</a>
              </td>
              <td>xxx</td>
            </tr>
            @endforeach
            </tbody>
           </table>
        </div>
    </div>
@endsection


@section('script')
	@parent
	<script>
	  $(function () {
	    $('#example1').DataTable()
	    $('#example2').DataTable({
	      'paging'      : true,
	      'lengthChange': false,
	      'searching'   : false,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false
	    })
	  })
	</script>
@endsection
@extends('admin')
@section('head')
	@parent
	<link rel="stylesheet" href="{{asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('header-title')
	<section class="content-header">
      <h1>
        User Management
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
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td><a href="{{route('users.show',['id'=>$user->id])}}">{{$user->name}}</a></td>
              <td>{{$user->email}}</td>
              <td>
              	<form class="delete" action="{{ route('users.destroy', $user->id) }}" method="POST">
                  <a href="{{route('users.edit',['id'=>$user->id])}}" role="button" class="btn btn-primary">Edit</a>
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="submit" value="Delete" class="btn btn-danger">
                </form>
              </td>
            </tr>
            @endforeach
            </tbody>
           </table>
           <div class="row">
            <div class="text-center">
              {{$users->links()}}
            </div>
           </div>
        </div>
    </div>
@endsection


@section('script')
	@parent
  <script src="{{asset('/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
	<script>
	  $(function () {  
	    $('#example1').DataTable({
	      'paging'      : true,
	      'lengthChange': true,
	      'searching'   : true,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false
	    })
	  })
	</script>
  <script>
    $(".delete").on("submit", function(){
        return confirm("Are you sure you want to delete?");
    });
  </script>
@endsection
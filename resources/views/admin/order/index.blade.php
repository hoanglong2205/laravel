@extends('admin')
@section('head')
  @parent
  <link rel="stylesheet" href="{{asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/app.css')}}">
@endsection

@section('header-title')
  <section class="content-header">
      <h1>
        Order Management
        <small>Orders List</small>
      </h1>
    </section>
@endsection

@section('content')
  <div class="box">
        <div class="box-header">
          <h3 class="box-title">Orders List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id (Code)</th>
              <th>User</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
            <tr>
              <td><a href="{{ route('admin.orders.show', $order->id) }}">{{$order->id}}</a></td>
              <td>{{$order->user->name}}</td>
              <td><a href="{{ route('admin.orders.show', $order->id) }}">{{$order->description}}</a></td>
              <td>{{$order->status}}
              </td>
              <td>
                {{ Form::open(array('action' => array('Admin\OrderController@update', $order->id,'class'=>'delivery'))) }}
                    {{ Form::hidden('_method', 'PATCH') }}
                    {{ Form::submit('Delivery', array('class' => 'btn btn-success','onclick'=>'return confirm("Confirm Delivery?");')) }}
                {{ Form::close() }}
                {{ Form::open(array('action' => array('Admin\OrderController@cancel', $order->id,'class'=>'cancel'))) }}
                    {{ Form::hidden('_method', 'PATCH') }}
                    {{ Form::submit('Cancel', array('class' => 'btn btn-danger','onclick'=>'return confirm("Are you sure want to cancel this order?");')) }}
                {{ Form::close() }}
              </td>
            </tr>
            @endforeach
            </tbody>
           </table>
           <div class="row">
            <div class="text-center">
              {{$orders->links()}}
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
@endsection
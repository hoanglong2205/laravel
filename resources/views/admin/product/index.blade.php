@extends('admin')
@section('head')
  @parent
  <link rel="stylesheet" href="{{asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('header-title')
  <section class="content-header">
      <h1>
        Product Management
        <small>Products List</small>
      </h1>
    </section>
@endsection

@section('content')
  <div class="box">
        <div class="box-header">
          <h3 class="box-title">Products List</h3>
          <div class="pull-right">
            <a href="{{route('products.create')}}" role="button" class="btn btn-primary">Create new product</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Price</i></th>
              <th>Category</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
            <tr>
              <td>{{$product->id}}</td>
              <td>{{$product->name}}</td>
              <td><i class="fa fa-fw fa-dollar"></i>{{$product->price}}</td>
              <td>{{$product->category->name}}</td>
              <td>{{$product->description}}</td>
              <td>
                <form class="delete" action="{{ route('products.destroy', $product->id) }}" method="POST">
                  <a href="{{route('products.edit',['id'=>$product->id])}}" role="button" class="btn btn-primary">Edit</a>
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
              {{$products->links()}}
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
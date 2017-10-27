@extends('admin')

@section('header-title')
  <section class="content-header">
      <h1>
        Category Management
        <small>Category Edit</small>
      </h1>
    </section>
@endsection

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit: {{$category->name}}</h3>
      <a href="{{ route('categories.index') }}" role="button" class="pull-right btn btn-warning">Back to Category List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($category, array('route' => array('categories.update', $category->id), 'method' => 'PUT', 'class' =>'edit')) }}
      <div class="box-body">
        <div class="form-group">
          <label>Name:</label>
          {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group"> 
          <label>Description:</label>
          {{ Form::textarea('description', null, array('class' => 'form-control')) }}
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        {{ Form::submit('Edit!', array('class' => 'btn btn-primary')) }}
      </div>
    {{ Form::close() }}
  </div>
@endsection

@section('script')
  @parent
  <script>
    $(".edit").on("submit", function(){
        return confirm("Edit category?");
    });
  </script>
@endsection
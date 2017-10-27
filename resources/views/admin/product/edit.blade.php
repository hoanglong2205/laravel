@extends('admin')

@section('header-title')
  <section class="content-header">
      <h1>
        Product Management
        <small>Product Edit</small>
      </h1>
    </section>
@endsection

@section('content')
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit: {{$product->name}}</h3>
      <a href="{{ route('products.index') }}" role="button" class="pull-right btn btn-warning">Back to Product List</a>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT','files'=>true)) }}
      <div class="box-body">
        <div class="form-group">
          <label>Name:</label>
          {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
          <label>Price:</label>
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-fw fa-money"></i></span>            
              {{Form::number('price', null, array('class'=>'form-control'))}}
          </div>
        </div>

        <div class="form-group">
          <label>Category:</label>
          {{Form::select('category_id', $categories, null, array('class'=>'form-control'))}}
        </div>

        <div class="form-group">
          <label>Update Product's image:</label></br>
          <img id="output_image" src="{{asset('images/' . $product->image)}}" border="0" height="real_height" width="real_width" onload="resizeImg(this, 200, 400);">
          {{Form::file('image',['onchange' =>'preview_image(event)'])}}
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
        return confirm("Edit product?");
    });
  </script>
  <script type='text/javascript'>
    function preview_image(event) 
    {
     var reader = new FileReader();
     reader.height = '200px';
     reader.width = '400px';
     reader.onload = function()
     {
      var output = document.getElementById('output_image');
      output.src = reader.result;
     }
     reader.readAsDataURL(event.target.files[0]);
    }
    function resizeImg(img, height, width) {
        img.height = height;
        img.width = width;
    }
  </script>
@endsection
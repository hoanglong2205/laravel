@extends('admin')

@section('header-title')
  <section class="content-header">
      <h1>
        Product Management
        <small>Create new</small>
      </h1>
    </section>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Create new Product</h3>
      <a href="{{ route('products.index') }}" role="button" class="pull-right btn btn-warning">Back to Product List</a>
    </div>
    {{ Form::open(array('route' => 'products.store','files'=>true)) }}
    <div class="box-body">

        {{Form::label('name', 'Name:')}}
        <div class="form-group">
            {{Form::text('name', null, array('class'=>'form-control'))}}
        </div>

        {{Form::label('price', 'Price:')}}
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-fw fa-money"></i></span>            
            {{Form::number('price', null, array('class'=>'form-control'))}}
        </div>

        {{Form::label('category_id', 'Category:')}}
        <select class="form-control" name="category_id">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>

        {{Form::label('image', 'Feature Image:')}}
        {{Form::file('image')}}

        {{Form::label('description', 'Description:')}}
        <div class="form-group">
            {{Form::textarea('description', null, array('class'=>'form-control'))}}
        </div>
    </div>
    <div class="box-footer">
        {{Form::submit('Create Product', array('class' => 'btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

@endsection
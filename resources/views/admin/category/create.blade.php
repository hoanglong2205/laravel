@extends('admin')

@section('header-title')
  <section class="content-header">
      <h1>
        Category Management
        <small>Create new</small>
      </h1>
    </section>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Create new Category</h3>
      <a href="{{ route('categories.index') }}" role="button" class="pull-right btn btn-warning">Back to Category List</a>
    </div>
    {{ Form::open(array('route' => 'categories.store')) }}
    <div class="box-body">
        <div class="form-group">
            {{Form::label('name', 'Name:')}}
            {{Form::text('name', null, array('class'=>'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description:')}}
            {{Form::textarea('description', null, array('class'=>'form-control'))}}
        </div>
    </div>
    <div class="box-footer">
        {{Form::submit('Create Category', array('class' => 'btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

@endsection
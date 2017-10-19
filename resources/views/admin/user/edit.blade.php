@extends('admin')
@section('content')
	<h1>Edit</h1>
	<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"> {{ $user->name }}'s infomations</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
      <div class="box-body">
        <div class="form-group">
          <label>Name:</label>
          {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group"> 
          <label>Email address:</label>
          {{ Form::email('email', null, array('class' => 'form-control')) }}
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        {{ Form::submit('Edit!', array('class' => 'btn btn-primary')) }}
      </div>
    {{ Form::close() }}
  </div>
@endsection
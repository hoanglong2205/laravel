@extends('admin')
@section('content')
		<h1>{{ $user->name }}</h1>
		<a href="{{route('users.edit',['id'=>$user->id])}}" role="button" class="btn btn-primary">Edit</a>
		{{ Form::open(['method'=>'DELETE', 'route'=>['users.destroy', $user->id]]) }}
		{{ Form::submit('Delete') }}
		{{ Form::close() }}
@endsection
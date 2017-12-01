@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="login-form"><!--login form-->
                    <h2 style="text-align: center;">Login to your account</h2>
                    <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                        <input id="password" type="password" placeholder="Password..." name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default" style="margin-left: 132px">Login</button>
                        <br>
                        <a href="redirect/facebook" style="margin-left: 20px"><img  src="{{asset('images/facebook.jpg')}}"></a>
                        <a href="redirect/google"><img  src="{{asset('images/google.jpg')}}"></a>
                        <a class="pull-right btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
    <br>
@endsection

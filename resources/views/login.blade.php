<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
    	<form method="post" action="{{ route('vali')}}">
    	{{ csrf_field() }}
    		Email : <input type="text" name="email">
    		<br>
    		Password :<input type="password" name="password">
    		<br>
    		<input type="submit" name="login" value="Login">
    	</form>
    </body>
</html>
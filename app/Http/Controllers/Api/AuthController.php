<?php

namespace App\Http\Controllers\Api;

use App\User;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt:auth')->only('refresh');
    }

    public function refresh()
    {
        $current_token  = JWTAuth::getToken();
        $token          = JWTAuth::refresh($current_token);

        return response()->json(compact('token'));
    }

    public function authenticate()
    {
        $credentials = request()->only('email','password');

        try{
            $token = JWTAuth::attempt($credentials);

            if(!$token) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        }

        catch(JWTException $e)
        {
            return response()->json(['error' => 'something went wrong'], 500);
        }

        return response()->json(['token' => $token], 200);
    }

    public function register()
    {
    	$name = request()->name;
    	$email = request()->email;
    	$password = request()->password;

    	$user = User::create([
    		'name' => $name,
    		'email' => $email,
    		'password' => bcrypt($password)
    		]);

    	$token = JWTAuth::fromUser($user);

    	return response()->json(['token' => $token], 200);
    }
}

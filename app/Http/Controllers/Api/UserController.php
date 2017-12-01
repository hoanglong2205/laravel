<?php

namespace App\Http\Controllers\Api;

use App\User;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('jwt:auth');
	}

    public function show()
    {
    	$user = JWTAuth::toUser(JWTAuth::getToken());

    	return $user;
    }
}

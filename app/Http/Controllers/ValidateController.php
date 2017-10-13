<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function bum(Request $request){
    	$request->validate([
    		'email' => 'required',
    		'password' => 'required',
    	]);
    	$email = $request->input('email');
    	return view('info')->with('email',$email);
    }
}

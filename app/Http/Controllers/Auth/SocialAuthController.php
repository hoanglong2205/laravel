<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Product;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Two\InvalidStateException;
use App\Social\FacebookServiceProvider;
use App\Social\GoogleServiceProvider;

class SocialAuthController extends Controller
{
	protected $providers = [
		'facebook' => FacebookServiceProvider::class,
		'google' => GoogleServiceProvider::class,
	];

	public function __construct()
	{
		$this->middleware('guest');
	}

    public function redirect($driver) 
    {
        return (new $this->providers[$driver])->redirect();
    }

    public function callback($driver) 
    {
    	$products = Product::paginate(6);
        $user = (new $this->providers[$driver])->handle();        
    	Auth::login($user);
        return view ( 'home' )->with('products',$products);
    }
}

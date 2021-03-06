<?php

namespace App\Social;

use Auth;
use App\User;
use Laravel\Socialite\Facades\Socialite;

class FacebookServiceProvider
{
	public function redirect()
	{
		return Socialite::driver('facebook')->stateless()->redirect();
	}

	public function handle()
	{
		$user = Socialite::driver('facebook')->stateless()->user();
		$existingUser = User::where('email', $user->email)->first();
		if ($existingUser) {
	      return $existingUser;
	    }

		$newUser = new User;
		$newUser->name = $user->name;
		$newUser->email= $user['email'];
		$newUser->password = bcrypt(str_random(15));
		
		$newUser->save();
		
		return $newUser;
	}
}
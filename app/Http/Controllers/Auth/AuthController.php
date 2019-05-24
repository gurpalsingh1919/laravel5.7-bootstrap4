<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\Http\Controllers\Controller;
use App\User;
class AuthController extends Controller
{
    
    /**
     **_ Redirect the user to the OAuth Provider.
     _**
     **_ @return Response
     _**/
     protected $redirectTo = '/';
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     _ Obtain the user information from provider.  Check if the user already exists in our
     _ database by looking up their provider_id in the database.
     _ If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     _ redirect them to the authenticated users homepage.
     _
     _ @return Response
     _**/
    public function handleProviderCallback($provider)
    {

    	//echo "<pre>";print_r($provider);
        $user = Socialite::driver($provider)->user();
       
        //echo "<pre>";print_r($user);die;
        $authUser = $this->findOrCreateUser($user, $provider);
        // echo "<pre>";print_r($authUser);
        // die;

        Auth::login($authUser, true);
        $cart = session()->get('cart');
	    if($cart)
	    {
	        return redirect()->intended('/check-out');
	    }
	     // return redirect()->intended('/');
        return redirect($this->redirectTo);
    }

    /**
     _ If a user has registered before using social auth, return the user
     _ else, create a new user object.
     _ @param  $user Socialite user object
     _ @param $provider Social auth provider
     _ @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        //echo $user->id;
        //echo $authUser;
       // echo "<pre>";print_r($user);
       // echo $user->avatar_original;print_r($user->id);
       // die;
        if ($authUser) {
            return $authUser;
        }
        else
        {
        	$filename ='user-default.jpg';
        	if($provider=='google' && !empty($user->avatar_original))
        	{
        		$image = file_get_contents($user->avatar_original);
        		$extentions = pathinfo($user->avatar_original,PATHINFO_EXTENSION);
        		//echo $extentions;die;
        		$filename = time().'-'.$user->id.'.' . $extentions;
        		file_put_contents('images/user/'.$filename, $image);
        	}
        	else if($provider=='facebook' && !empty($user->avatar_original))
        	{
        		$image = file_get_contents($user->avatar_original);
        		$extentions = 'jpg';
        		//echo $extentions;die;
        		$filename = time().'-'.$user->id.'.' . $extentions;
        		file_put_contents('images/user/'.$filename, $image);

        	}
        	//die;

        	$input=[
            'name'     => $user->name,
            'email'    => $user->email,
            'image' => $filename,
            'status' =>'1',
            'provider' => $provider,
            'provider_id' => $user->id
        	];
        	$user = User::create($input);
        	$user->assignRole('9');

        	return $user;
        }
        //return User::create();
    }
}

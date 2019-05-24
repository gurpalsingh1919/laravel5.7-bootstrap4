<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function updateAuthUserPassword(Request $request)
    {
        $this->validate($request, [
            'current' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current, $user->password)) {
            
            $message="Current password does not match";
            return redirect()->back()->with('error', $message);
        }
        else
        {
        	$user->password = Hash::make($request->password);
        	$user->save();
        	$message="Congratulation !! Your password has been successfully changed.";
            return redirect()->back()->with('success', $message);
        }
	}
    public function changeProfilePicture(Request $request)
    {
    	//echo "<pre>";print_r($request->all());die;
    	  $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->move('images/user',$avatarName);
       // $gym_images->move($gymsfile_path, $gym_imagesname);
        $user->image = $avatarName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');


    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try{
            $user = Socialite::driver('google')->user();
            $findUser = User::where('social_id',$user->getId())->first();
            if($findUser){
                Auth::login($findUser);
                return redirect('http://localhost:8000/');            }
            else{
                $newUser = User::create([
                    'name'=>$user->getName(),
                    'email' => $user->getEmail(),
                    'social_id' => $user->getId(),
                    'image' => $user->getAvatar(),
                    'social_type' => 'google',
                    'password' => Hash::make('my-google'),
                ]);
                Auth::login($newUser);
                return redirect('http://localhost:8000/');            }
        }catch (Exception $e){
            return $e->getMessage();
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GithubController extends Controller
{
    function redirectToProvider() {
        return Socialite::driver('github')->redirect();

    }
    function redirectToWebsite() {
        $user = Socialite::driver('github')->user();
        if(CustomerLogin::where('email', $user->getEmail())->exists()){
            if(Auth::guard('customerlogin')->attempt(['email'=> $user->getEmail(), 'password'=>'~wA!rP2PR5-cFJ/V'])) {
                return redirect('/');
             }

        }
        else {
            CustomerLogin::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('~wA!rP2PR5-cFJ/V'),
                'created_at' => Carbon::now(),
            ]);
            if(Auth::guard('customerlogin')->attempt(['email'=> $user->getEmail(), 'password'=>'~wA!rP2PR5-cFJ/V'])) {
               return redirect('/');
            }

        }

    }
}

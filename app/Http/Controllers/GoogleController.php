<?php

namespace App\Http\Controllers;
use App\Models\CustomerLogin;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GoogleController extends Controller
{
    function redirectToProvider() {
        return Socialite::driver('google')->redirect();

    }
    function redirectToWebsite() {
        $user = Socialite::driver('google')->user();
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

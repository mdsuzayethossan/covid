<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use App\Models\CustomPasswordReset;
use App\Notifications\CustomerPassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PasswordResetcontroller extends Controller
{
    function forgotpassword() {
        return view('CustomAuth.custom_pass_reset');
    }
    function forgot_send_email(Request $request) {
        $check_existing_email = CustomerLogin::where('email', $request->email)->first();
        if(CustomerLogin::where('email', $request->email)->exists()) {

        $password_reset = CustomPasswordReset::create([
            'customer_id' => $check_existing_email->first()->id,
            'reset_token' => uniqid(),
            'created_at' => Carbon::now(),

        ]);

        }
        else {
            return back()->with('notregistered', 'This email address is not registered');
        }

         Notification::send($check_existing_email, new CustomerPassResetNotification);


    }
}

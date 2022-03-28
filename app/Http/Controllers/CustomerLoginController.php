<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    function customerlogin(Request $request)
    {
        if (Auth::guard('customerlogin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        } else {
            return redirect('/customer_register');
        }
    }
    function customer_profile(){
        $orders = Order::where('user_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.customer_profile', [
            'orders' => $orders,
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use Illuminate\Support\Facades\Auth;

class CustomerRegisterController extends Controller
{
    function customer_register() {
        return view('auth.auth_register');
    }
    function customerregister(Request $request)
    {
        CustomerLogin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);
        return back()->with('registersuccess', 'Registered successfully');
    }
    function customer_update(Request $request) {
        CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('customer_update', 'Updated successfully');
        
    }
    public function customer_singout() {
        Auth::guard('customerlogin')->logout();
        return redirect('/customer_register');
      }
}

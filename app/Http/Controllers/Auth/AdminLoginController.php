<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin-auth.login');
    }

    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember)) {
            return redirect()->intended(route('home'));
        }
        $data = Admin::where('email', $request->email)->where('password', Hash::make($request->password))->first();
        if ($data) {
            return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'User is Inactive');
        } else {
            return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'Invalid Credential');
        }

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}

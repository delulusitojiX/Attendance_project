<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Check if the user is an admin
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.attendance'); // Redirect to home if login is successful
        }

        return back()->with('error', 'Invalid username or password.');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    
     public function login(Request $request)
    {
      
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
               return redirect()->route('dashboard');
            }
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email', 'remember'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function dashboard()
    {
        try {
            return view('dashboard');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}

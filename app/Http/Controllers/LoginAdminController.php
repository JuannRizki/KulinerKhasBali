<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');  // Pastikan file ini ada di resources/views/admin/
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');  // Pastikan file ini ada di resources/views/admin/
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}

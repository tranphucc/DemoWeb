<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Kiểm tra nếu là admin
        if ($user->role === 'admin') {
            return redirect()->route('admin'); // Chuyển đến trang admin
        }

        // Nếu là user thường
        return redirect()->route('user'); // Chuyển đến trang user
    }

    return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;

class AdminAuthController extends Controller
{
    // 管理者ログインフォームの表示
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function index()
    {
        return view('admin.index');
    }

    // 管理者ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(route('admin.index')); 
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // 管理者ログアウト処理
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // 管理者登録フォームの表示
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // 管理者登録処理
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ログイン処理を実行
        Auth::guard('admin')->login($admin);

        return redirect()->intended(route('admin.dashboard'));
    }
}

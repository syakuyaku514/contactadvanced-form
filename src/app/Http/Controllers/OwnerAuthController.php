<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Owner;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class OwnerAuthController extends Controller
{
    // ログインフォームを表示
    public function showLoginForm()
    {
        return view('owner.login');
    }

    public function index()
    {
        return view('owner.index');
    }

    // ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('owner')->attempt($credentials)) {
            Log::info('Owner login successful', ['owner' => Auth::guard('owner')->user()]);
            return redirect()->route('owner.index');
        }
        // 失敗時にリダイレクト
        return redirect()->route('owner.login');
    }

    // ログアウト処理
    public function logout()
    {
        Auth::guard('owner')->logout();
        return redirect()->route('owner.login');
    }

    // 登録フォームを表示
    public function showRegisterForm()
    {
        return view('owner.register');
    }

    // 登録処理
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:owners',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $owner = Owner::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'owner',
        ]);

        Auth::guard('owner')->login($owner);

        return redirect()->route('owner.login');
    }
}
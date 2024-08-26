<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use App\Models\Owner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralNotificationMail;


class AdminAuthController extends Controller
{
    // 管理者ログインフォームの表示
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function index()
    {
        $owners = Owner::all();
        return view ('admin.index',compact('owners'));
    }


    // 管理者ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
        Log::info('Admin login successful', ['admin' => Auth::guard('admin')->user()]);
        return redirect()->route('admin.index');
    }
        // 失敗時にリダイレクト
        return redirect()->route('admin.login');
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
            'role' => 'admin',
        ]);

        // ログイン処理を実行
        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.index');
    }

    

    // 店舗代表者登録フォームを表示
    public function OwnerRegisterForm()
    {
        return view('owner.register');
    }

    // 店舗代表者登録処理
    public function Oregister(Request $request)
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

    // メール送信フォームの表示
    public function showSendEmailForm()
    {
        return view('admin.send_email');
    }

    // メール送信処理
    public function sendEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $email = $request->input('email');
    $subject = $request->input('subject');
    $message = $request->input('message');

    // メールの送信
    Mail::to($email)->send(new GeneralNotificationMail($subject, $message));

    return redirect()->route('admin.sendEmailForm')->with('success', 'メールが送信されました。');
}
    
}

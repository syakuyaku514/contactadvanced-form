<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function thanks()
    {
        return view('register_thanks');
    }

    public function mypage()
    {
        return view('mypage');
    }

    public function done()
    {
        return view('done');
    }

    public function detail()
    {
        return view('detail');
    }
    
    
}

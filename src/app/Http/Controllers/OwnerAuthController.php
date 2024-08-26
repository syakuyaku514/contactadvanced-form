<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Owner;
use App\Models\User;
use App\Models\Role;
use App\Models\Store;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OwnerAuthController extends Controller
{
    // ログインフォームを表示
    public function showLoginForm()
    {
        return view('owner.login');
    }
    
    // 画面表示
    public function index()
    {
        $stores = Store::all();
        $regions = Region::all(); 
        $genres = Genre::all();
        $reservations = Reservation::all();

        return view('owner.index', compact('stores', 'regions', 'genres', 'reservations'));
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
        return view('owner.login');
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

        return redirect()->route('admin.index');
    }

    // 店舗追加機能
    public function create(Request $request)
    {
        // バリデーション
        $request->validate([
            'store' => 'required|string',
            'region_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'overview' => 'required|string',
            'image' => 'required|image',
        ]);
    

        // 画像の保存
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('images',  $imageName, 'public');
        }

         // 店舗情報の保存
         Store::create([
            'store' => $request->input('store'),
            'region_id' => $request->input('region_id'),
            'genre_id' => $request->input('genre_id'),
            'overview' => $request->input('overview'),
            'image' => $imagePath,
        ]);


        return redirect()->route('owner.index');
    }

    // 店舗情報削除
    public function delete(Request $request, $id)
    {
        Store::find($id)->delete();
        return redirect()->route('owner.index')->with('success', '店舗情報が削除されました');
    }

    // 店舗情報更新ページの表示
    public function edit($id){
        $store = Store::findOrFail($id);
        $regions = Region::all(); 
        $genres = Genre::all();
        return view('owner.edit', compact('store','regions','genres'));
    }

    // 店舗情報更新機能
    public function update(Request $request, $id)
    {
        $store = Store::find($id);

        if ($store) {
            $store->store = $request->input('store');
            $store->region_id = $request->input('region_id');
            $store->genre_id = $request->input('genre_id');
            $store->overview = $request->input('overview');

            // 画像がアップロードされているかチェック
            if ($request->hasFile('image')) {
                // 古い画像がある場合、削除する
                if ($store->image && Storage::exists('public/' . $store->image)) {
                    Storage::delete('public/' . $store->image);
                }

                // 新しい画像を保存
                $imagePath = $request->file('image')->store('images', 'public');
                $store->image = $imagePath;
            }

            $store->save();
            return redirect()->route('owner.index')->with('success', '店舗情報が更新されました');
        } else {
            return redirect()->route('owner.index')->with('error', '店舗情報が見つかりません');
        }
    }

}
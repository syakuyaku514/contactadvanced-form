<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request, Store $store)
    {
        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('store_id', $store->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'store_id' => $store->id,
            ]);
        }

        return back();
    }
}

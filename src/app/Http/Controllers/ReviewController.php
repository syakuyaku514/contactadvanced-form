<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Genre;
use App\Models\Region;
use App\Models\Review;

class ReviewController extends Controller
{
    public function show($id)
    {
        $store = Store::with(['region', 'genre'])->find($id);
        $reviews = Review::where('store_id', $id)->with('user')->get();
        $cards = Store::with(['region', 'genre'])->get();
        $regions = Region::all(); 
        $genres = Genre::all();

        return view('review', compact('store', 'cards', 'regions', 'genres', 'reviews'));
    }

    public function review(ReviewRequest $request, $id)
    {
        Review::create([
            'user_id' => auth()->id(),
            'store_id' => $id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);

        return redirect()->route('review', $id)->with('success', 'レビューを送信しました');
    }

    public function destroy(Request $request, $id)
    {
        $review = Review::find($id);
        $review->delete();

        return redirect()->route('store.detail', $review->store_id)->with('message', 'レビューを削除しました');
    }

    public function update(Request $request, $id)
    {
        // レビューを取得
        $review = Review::find($id);

        // レビューの更新
        $review->update([
            'stars' => $request->input('stars'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('store.detail', $review->store_id)->with('message', 'レビューを更新しました');
    }
}

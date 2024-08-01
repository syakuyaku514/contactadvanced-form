<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Genre;
use App\Models\Region;
use App\Models\REview;
use App\Models\StoreReview;

class StoreReviewController extends Controller
{
    public function review ($id)
    {
        $store = Store::with(['region','genre'])->find($id);
        $storeReviews = StoreReview::where('store_id', $id)->with('user')->get();
        $cards = Store::with(['region', 'genre'])->get();
        $regions = Region::all(); 
        $genres = Genre::all();

        return view ('review',compact('store', 'cards', 'regions', 'genres','storeReviews'));
    }

    public function storeReview(Request $request,$id)
    {
        storeReview::create([
            'user_id' => auth()->id(),
            'store_id' => $id,
            'stars' => $request->star_rating,
            'comment' => $request->body,
        ]);

        return redirect()->route('review',$id)->with('success','レビューを送信しました');
    }

    public function destroy(Request $request, $id)
    {
        $review = StoreReview::find($id);
        $review->delete();

        return redirect()->route('review', $review->store_id)->with('message', 'レビューを削除しました');
    }

    public function update(Request $request, $id)
    {
        // レビューを取得
        $storereview = StoreReview::find($id);

        // レビューの更新
        $storereview->update([
            'stars' => $request->input('stars'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('review', $storereview->store_id)->with('message', 'レビューを更新しました');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Favorite;

class FavoriteController extends Controller
{
	public function toggle($itemId)
	{
		$user = auth()->user();
		$favorite = Favorite::where('user_id', $user->id)->where('item_id', $itemId)->first();

		if ($favorite) {
			$favorite->delete();
			return redirect()->back()->with('error', 'お気に入りを解除しました。');
		} else {
			Favorite::create([
				'user_id' => $user->id,
				'item_id' => $itemId,
			]);
			return redirect()->back()->with('success', 'お気に入りに追加しました。');
		}
	}
}

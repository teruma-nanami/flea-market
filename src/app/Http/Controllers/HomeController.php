<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Item;

class HomeController extends Controller
{

	public function index()
	{
		$items = Item::where('user_id', '!=', auth()->id())->get();
		$favorites = Auth::check() ? Auth::user()->favorites : collect();
		$query = null;

		return view('index', compact('items', 'favorites', 'query'));
	}
	public function search(SearchRequest $request)
	{
		$query = $request->input('query');

		if (empty($query)) {
			return redirect()->route('index'); // クエリが空の場合はindexページにリダイレクト
		}

		$items = Item::where('title', 'LIKE', "%{$query}%")->get();

		if (auth()->check()) {
			$user = auth()->user();
			$favorites = $user ? $user->favorites()->where(function ($q) use ($query) {
				$q->where('title', 'LIKE', "%{$query}%");
			})->get() : collect();
		} else {
			$favorites = [];
		}

		return view('index', compact('items', 'favorites', 'query'));
	}

	public function show($id)
	{
		$item = Item::with('categories', 'favorites')->findOrFail($id);
		$favorites = auth()->check() ? auth()->user()->favorites->pluck('id')->toArray() : [];

		return view('detail', compact('item', 'favorites'));
	}


	public function mypage()
	{
		$user = Auth::user();
		$myItems = $user->items;
		$purchasedItems = Item::where('buyer_id', $user->id)->get();

		return view('mypage', compact('myItems', 'purchasedItems'));
	}

	public function profileShow()
	{
		return view('profile');
	}

	public function profileEdit()
	{
		return view('edit');
	}

	public function profileUpdate(HomeRequest $request)
	{
		$user = Auth::user();
		$user->name = $request->name;
		$user->post_code = $request->post_code;
		$user->address = $request->address;
		$user->building = $request->building;

		if ($request->hasFile('image_url')) {
			$imagePath = $request->file('image_url')->store('profile_images', 'public');
			$user->image_url = '/storage/' . $imagePath;
		}

		// $user->profile_completed = true;
		$user->save();

		return redirect()->route('profile.show')->with('success', 'プロフィールが更新されました。');
	}

	public function addressEdit($id)
	{
		return view('address', ['id' => $id]);
	}

	public function addressUpdate(HomeRequest $request, $id)
	{

		$user = Auth::user();
		$user->post_code = $request->post_code;
		$user->address = $request->address;
		$user->building = $request->building;
		$user->save();

		session(['item_id' => $request->item_id]);

		return redirect()->route('purchase.show', ['id' => $id])->with('success', '配送先が更新されました。');
	}
}

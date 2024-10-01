<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeRequest;
use App\Models\Item;

class HomeController extends Controller
{

	public function index()
	{
		$items = Item::all();
		$favorites = Auth::check() ? Auth::user()->favorites : collect();

		return view('index', compact('items', 'favorites'));
	}

	public function show($id)
	{
		$item = Item::findOrFail($id);
		return view('detail', compact('item'));
	}

	public function mypage()
	{
		$user = Auth::user();
		$myItems = $user->items;
		$purchasedItems = Item::where('is_sold', true)->where('user_id', $user->id)->get();

		return view('mypage', compact('myItems', 'purchasedItems'));
	}

	public function profileShow()
	{
		return view('profile');
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

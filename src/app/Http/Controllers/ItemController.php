<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
	public function create()
	{
		$categories = Category::all();
		return view('listing', compact('categories'));
	}

	public function store(ItemRequest $request)
	{
		$imagePath = $request->file('image_url')->store('item_images', 'public');

		$description = $request->description;
		if (empty($description)) {
			$description = '説明文はありません';
		}

		$item = Item::create([
			'user_id' => Auth::id(),
			'title' => $request->name,
			'description' => $description,
			'price' => $request->price,
			'image_url' => '/storage/' . $imagePath,
			'status' => $request->status,
			'is_sold' => false,
		]);

		$item->categories()->attach($request->category_ids);
		
		return redirect()->route('items.completed');
	}

	public function show($id)
	{
		$item = Item::findOrFail($id);
		return view('purchase', compact('item'));
	}

	public function purchace(Request $request, $id)
	{
		$item = Item::findOrFail($id);

		if ($item->is_sold) {
			return redirect()->route('item.show', $id)->with('error', 'この商品は既に売却されています。');
		}

		$item->is_sold = true;
		$item->buyer_id = Auth::id();
		$item->save();

		// 購入処理をここに追加（例：購入履歴の保存など）

		return redirect()->route('purchase.thanks');
	}
	public function thanks()
	{
		return view('thanks');
	}

	public function completed()
	{
		return view('completed');
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('listing', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'condition' => 'required|string|in:new,used',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image_url')->store('item_images', 'public');

        $item = Item::create([
            'user_id' => Auth::id(),
            'title' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => '/storage/' . $imagePath,
            'is_sold' => false,
        ]);

        $item->categories()->attach($request->categories);

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

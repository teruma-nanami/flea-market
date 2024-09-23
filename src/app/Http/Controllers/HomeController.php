<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeRequest;

class HomeController extends Controller
{
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
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
	public function store(CommentRequest $request, $itemId)
	{
		$comment = new Comment();
		$comment->user_id = auth()->id();
		$comment->item_id = $itemId;
		$comment->content = $request->input('content');
		$comment->save();

		return redirect()->back()->with('success', 'コメントが追加されました。');
	}
}

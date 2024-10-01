<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'name' => 'required|string|max:255',
			'category_id' => 'required|exists:categories,id',
			'status' => 'required|string|in:新品,未使用に近い,目立った汚れなし,傷や汚れあり,状態が悪い',
			'price' => 'required|numeric|min:0',
			'description' => 'nullable|string',
		];
	}
}

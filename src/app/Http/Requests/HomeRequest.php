<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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
			'post_code' => ['required', 'string', 'max:10'],
			'address' => ['required', 'string', 'max:191'],
			'buiiding' => ['nullable', 'string', 'max:191'],
		];
	}
}

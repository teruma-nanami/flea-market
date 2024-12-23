<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
        return ['query' => 'required|string|min:1|max:255',];
    }
    public function messages()
    {
        return [
            'query.required' => '何か検索窓に文字を入力してください。',
            'query.max' => '検索クエリは255文字以内でなければなりません。',
        ];
    }
}

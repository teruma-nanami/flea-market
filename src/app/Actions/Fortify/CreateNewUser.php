<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
	use PasswordValidationRules;

	/**
	 * Validate and create a newly registered user.
	 *
	 * @param  array<string, string>  $input
	 */
	public function create(array $input): User
	{
		Validator::make($input, [
			'name' => ['required', 'string', 'max:191'],
			// nameカラムは必須、string型、最大191文字
			'email' => [
				'required',
				'string',
				'email',
				'max:191',
				Rule::unique(User::class),
			],
			'password' => ['required', 'string', 'min:8', 'max:191', 'confirmed'],
		])->validate();

		return User::create([
			'name' => $input['name'],
			'email' => $input['email'],
			'password' => Hash::make($input['password']),
			'password_digest' => Hash::make($input['password']),
		]);
	}
}

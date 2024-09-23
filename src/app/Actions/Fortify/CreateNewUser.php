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
			'post_code' => ['required', 'string', 'max:10'],
			'address' => ['required', 'string', 'max:191'],
			'buiiding' => ['nullable', 'string', 'max:191'],
			'image_url' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:191',	Rule::unique(User::class),],
			'password' => ['required', 'string', 'min:8', 'max:191', 'confirmed'],
		])->validate();

		return User::create([
			'name' => $input['name'],
			'email' => $input['email'],
			'password' => Hash::make($input['password']),
			'password_digest' => Hash::make($input['password']),
			'email_verified_at' => null,
			'image_url' => 'storage/default/default.png'
		]);
	}
}

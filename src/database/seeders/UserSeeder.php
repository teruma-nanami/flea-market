<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// 管理者データを作成
		User::create([
			'name' => 'Admin User',
			'post_code' => '123-4567',
			'address' => 'Admin Address',
			'email' => 'admin@example.com',
			'email_verified_at' => now(),
			'password' => bcrypt('password'), // パスワードをハッシュ化
			'password_digest' => bcrypt('password'), // パスワードダイジェストをハッシュ化
			'image_url' => '/img/default.png',
			'remember_token' => Str::random(10),
			'created_at' => now(),
			'updated_at' => now(),
		]);
		User::factory()->count(49)->create();
	}
}

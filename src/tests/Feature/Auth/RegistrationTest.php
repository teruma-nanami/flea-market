<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function name_is_required_for_registration()
	{ // ユーザー情報を作成
		$userData = [
			'name' => '',
			'email' => 'test@example.com',
			'password' => 'password',
			'password_confirmation' => 'password',
		];
		// 会員登録ページを開く
		$response = $this->get('/register');

		// フォームを送信（名前を入力せずに）
		$response = $this->post('/register', $userData);

		// バリデーションエラーメッセージを確認
		$response->assertSessionHasErrors(['name' => 'お名前を入力してください']);
	}

	/** @test */
	public function email_is_required_for_registration()
	{
		// ユーザー情報を作成（メールアドレスを除く）
		$userData = [
			'name' => 'Test User',
			'password' => 'password',
			'password_confirmation' => 'password',
		];

		// 会員登録ページを開く
		$response = $this->get('/register');

		// POSTリクエストを送信
		$response = $this->post('/register', $userData);

		// バリデーションエラーメッセージを確認
		$response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
	}

	/** @test */
	public function password_is_required_for_registration()
	{
		// ユーザー情報を作成（パスワードを除く）
		$userData = [
			'name' => 'Test User',
			'email' => 'testuser@example.com',
		];

		// 会員登録ページを開く
		$response = $this->get('/register');

		// POSTリクエストを送信
		$response = $this->post('/register', $userData);

		// バリデーションエラーメッセージを確認
		$response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
	}

	/** @test */
	public function password_must_be_at_least_8_characters()
	{
		// ユーザー情報を作成（7文字のパスワードを含む）
		$userData = [
			'name' => 'Test User',
			'email' => 'testuser@example.com',
			'password' => 'short',
			'password_confirmation' => 'short',
		];

		// 会員登録ページを開く
		$response = $this->get('/register');

		// POSTリクエストを送信
		$response = $this->post('/register', $userData);

		// バリデーションエラーメッセージを確認
		$response->assertSessionHasErrors(['password' => 'パスワードは8文字以上で入力してください']);
	}
	/** @test */
	public function passwords_must_match_for_registration()
	{
		// ユーザー情報を作成（パスワードと確認用パスワードが一致しない）
		$userData = [
			'name' => 'Test User',
			'email' => 'testuser@example.com',
			'password' => 'password123',
			'password_confirmation' => 'password456',
		];

		// 会員登録ページを開く
		$response = $this->get('/register');

		// POSTリクエストを送信
		$response = $this->post('/register', $userData);

		// バリデーションエラーメッセージを確認
		$response->assertSessionHasErrors(['password' => 'パスワードと一致しません']);
	}
	/** @test */
	public function successful_registration_redirects_to_login()
	{
		// ユーザー情報を作成
		$userData = [
			'name' => 'Test User',
			'email' => 'testuser@example.com',
			'password' => 'password',
			'password_confirmation' => 'password',
		];

		// 会員登録ページを開く
		$response = $this->get('/register');

		// 全ての必要項目を正しく入力してPOSTリクエストを送信
		$response = $this->post('/register', $userData);

		// ユーザーが登録されていることを確認
		$this->assertDatabaseHas('users', [
			'email' => 'testuser@example.com',
		]);

		// ログイン画面にリダイレクトされることを確認
		$response->assertRedirect('/');
	}
}

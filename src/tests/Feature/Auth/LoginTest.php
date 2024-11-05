<?php

namespace Tests\Feature\Auth;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function email_is_required_for_login()
  {
    // ユーザー情報を作成
    $userData = [
      'email' => '',
      'password' => 'password123',
    ];

    // ログインページを開く
    $response = $this->get('/login');

    // メールアドレスを入力せずに他の必要項目を入力してPOSTリクエストを送信
    $response = $this->post('/login', $userData);

    // バリデーションエラーメッセージを確認
    $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
  }
  /** @test */
  public function password_is_required_for_login()
  {
    // ユーザー情報を作成
    $userData = [
      'email' => 'testuser@example.com',
      'password' => '',
    ];

    // ログインページを開く
    $response = $this->get('/login');

    // パスワードを入力せずに他の必要項目を入力してPOSTリクエストを送信
    $response = $this->post('/login', $userData);

    // バリデーションエラーメッセージを確認
    $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
  }
  /** @test */
  public function login_information_is_incorrect()
  {
    // ユーザー情報を作成（登録されていない情報を入力）
    $userData = [
      'email' => 'nonexistent@example.com',
      'password' => 'wrongpassword',
    ];

    // ログインページを開く
    $response = $this->get('/login');

    // 必要項目を入力してPOSTリクエストを送信
    $response = $this->post('/login', $userData);

    // バリデーションエラーメッセージを確認
    $response->assertSessionHasErrors(['email' => 'ログイン情報が登録されていません']);
  }
  /** @test */
  public function user_can_login_with_correct_credentials()
  {
    // テスト用ユーザーを作成
    $user = User::factory()->create([
      'email' => 'testuser@example.com',
      'password' => bcrypt('password123'),
    ]);

    // ログインページを開く
    $response = $this->get('/login');

    // 正しい情報を入力してPOSTリクエストを送信
    $response = $this->post('/login', [
      'email' => $user->email,
      'password' => 'password123',
    ]);

    // ログイン処理が実行されることを確認
    $response->assertRedirect('/'); // ログイン後のリダイレクト先を確認

    $this->assertAuthenticatedAs($user);
  }
}

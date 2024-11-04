<?php

namespace Tests\Feature\Auth;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LogoutTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function user_can_logout_successfully()
  {
    // テスト用ユーザーを作成してログインする
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

    // ログアウトボタンを押す
    $response = $this->post('/logout');

    // ログアウト処理が実行されることを確認
    $response->assertRedirect('/login');
    $this->assertGuest();
  }
}

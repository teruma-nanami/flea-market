<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ProfileInitialValuesTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function profile_page_displays_initial_values_correctly()
  {
    // テスト用ユーザーを作成して過去の設定を入力
    $user = User::factory()->create([
      'name' => 'Test User',
      'image_url' => '/img/default.png',
      'post_code' => '123-4567',
      'address' => '東京都渋谷区神南1-1-1',
      'building' => 'Test Building',
    ]);

    // ユーザーとしてログイン
    $this->actingAs($user);

    // プロフィールページを開く
    $response = $this->get('/profile/edit'); // プロフィール編集画面のルートを確認
    $response->assertStatus(200);

    // プロフィール画像が初期値として表示されていることを確認
    $response->assertSee('<img src="//img/default.png"', false);

    // ユーザー名が初期値として表示されていることを確認
    $response->assertSee('value="Test User"', false);

    // 郵便番号が初期値として表示されていることを確認
    $response->assertSee('value="123-4567"', false);

    // 住所が初期値として表示されていることを確認
    $response->assertSee('value="東京都渋谷区神南1-1-1"', false);

    // 建物名が初期値として表示されていることを確認
    $response->assertSee('value="Test Building"', false);
  }
}

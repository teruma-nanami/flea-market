<?php

namespace Tests\Feature\Item;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Item;

class ItemSearchTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function items_can_be_searched_by_partial_name()
  {
    // テスト用ユーザーを作成
    $user = User::factory()->create();

    // アイテムを作成
    Item::create([
      'user_id' => $user->id,
      'title' => '腕時計',
      'description' => 'スタイリッシュなデザインのメンズ腕時計',
      'price' => 15000,
      'status' => '未使用に近い',
      'image_url' => '/img/Armani+Mens+Clock.jpg',
      'is_sold' => false,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    Item::create([
      'user_id' => $user->id,
      'title' => 'HDD',
      'description' => '高速で信頼性の高いハードディスク',
      'price' => 5000,
      'status' => '目立った傷や汚れなし',
      'image_url' => '/img/HDD+Hard+Disk.jpg',
      'is_sold' => false,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // 部分一致検索をシミュレート
    $response = $this->post('/search', ['query' => '腕']);

    // ステータスコードが200であることを確認
    $response->assertStatus(200);

    // 検索結果に「腕時計」が表示されることを確認
    $response->assertSee('腕時計');

    // 検索結果に「HDD」が表示されないことを確認
    $response->assertDontSee('HDD');
  }
}

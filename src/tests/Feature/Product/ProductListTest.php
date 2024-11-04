<?php

namespace Tests\Feature\Product;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Item;

class ProductListingTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function all_products_are_displayed_on_the_homepage()
  {
    // テスト用ユーザーを作成
    $user = User::factory()->create();

    // テスト用商品をユーザーに関連付けて作成
    Item::insert([
      [
        'user_id' => $user->id,
        'title' => '腕時計',
        'description' => 'スタイリッシュなデザインのメンズ腕時計',
        'price' => 15000,
        'status' => '未使用に近い',
        'image_url' => '/img/Armani+Mens+Clock.jpg',
        'is_sold' => false,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => $user->id,
        'title' => 'HDD',
        'description' => '高速で信頼性の高いハードディスク',
        'price' => 5000,
        'status' => '目立った傷や汚れなし',
        'image_url' => '/img/HDD+Hard+Disk.jpg',
        'is_sold' => false,
        'created_at' => now(),
        'updated_at' => now(),
      ]
      // 必要に応じて他の商品データを追加
    ]);

    // 商品ページ（ホームページ）を開く
    $response = $this->get('/');

    // ステータスコードが200であることを確認
    $response->assertStatus(200);

    // すべての商品が表示されていることを確認
    $items = Item::all();
    foreach ($items as $item) {
      $response->assertSee($item->title);
    }
  }
}

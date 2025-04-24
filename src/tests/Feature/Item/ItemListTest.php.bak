<?php

namespace Tests\Feature\Item;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Item;

class ItemListingTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function all_Items_are_displayed_on_the_homepage()
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
  /** @test */
  public function sold_items_are_displayed_with_sold_label()
  {
    // テスト用ユーザーを作成
    $user = User::factory()->create();

    // 購入済みの商品を作成
    Item::insert([
      [
        'user_id' => $user->id,
        'title' => '腕時計',
        'description' => 'スタイリッシュなデザインのメンズ腕時計',
        'price' => 15000,
        'status' => '未使用に近い',
        'image_url' => '/img/Armani+Mens+Clock.jpg',
        'is_sold' => true, // 購入済みフラグをtrueに設定
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
    ]);

    // 商品ページ（ホームページ）を開く
    $response = $this->get('/');

    // ステータスコードが200であることを確認
    $response->assertStatus(200);

    // 購入済み商品に「SOLD」のラベルが表示されていることを確認
    $response->assertSeeInOrder(['腕時計', 'SOLD']); // 商品タイトルと「SOLD」ラベルの順序で表示を確認
  }
  /** @test */
  public function user_does_not_see_their_own_items_in_listing()
  {
    // テスト用ユーザーを作成
    $user = User::factory()->create();

    // 他のユーザーを作成
    $otherUser = User::factory()->create();

    // 自分が出品した商品を作成
    Item::insert([
      [
        'user_id' => $user->id,
        'title' => '自分の商品1',
        'description' => '自分が出品した商品です',
        'price' => 1000,
        'status' => '新品',
        'image_url' => '/img/myitem1.jpg',
        'is_sold' => false,
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ]);

    // 他のユーザーが出品した商品を作成
    Item::insert([
      [
        'user_id' => $otherUser->id,
        'title' => '他の商品1',
        'description' => '他のユーザーが出品した商品です',
        'price' => 2000,
        'status' => '新品',
        'image_url' => '/img/otheritem1.jpg',
        'is_sold' => false,
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ]);

    // ユーザーとしてログイン
    $this->actingAs($user);

    // 商品ページ（ホームページ）を開く
    $response = $this->get('/');

    // ステータスコードが200であることを確認
    $response->assertStatus(200);

    // 他のユーザーの商品が表示されることを確認
    $response->assertSee('他の商品1');

    // 自分が出品した商品が表示されないことを確認
    $response->assertDontSee('自分の商品1');
  }
}

<?php

namespace Tests\Feature\Item;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Category;

class ItemDetailTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function item_detail_page_displays_all_required_information()
  {
    // テスト用ユーザーを作成
    $user = User::factory()->create();

    // 商品を作成
    $item = Item::create([
      'user_id' => $user->id,
      'title' => '腕時計',
      'description' => 'スタイリッシュなデザインのメンズ腕時計',
      'price' => 15000,
      'status' => '新品',
      'image_url' => '/img/Armani+Mens+Clock.jpg',
      'is_sold' => false,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // コメントを作成
    Comment::create([
      'user_id' => $user->id,
      'item_id' => $item->id,
      'content' => '素晴らしい商品です！',
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // 商品詳細ページを開く
    $response = $this->get('/item/' . $item->id);

    // ステータスコードが200であることを確認
    $response->assertStatus(200);

    // 商品詳細ページに必要な情報が表示されていることを確認
    $response->assertSee($item->title);
    $response->assertSee(number_format($item->price));
    $response->assertSee($item->description);
    $response->assertSee($item->status);
    $response->assertSeeInOrder(['カテゴリ', '新品']); // カテゴリを仮定
    $response->assertSeeInOrder(['コメント', '1']); // コメント数を仮定
    $response->assertSee($user->name);
    $response->assertSee('素晴らしい商品です！');
  }
  /** @test */
  public function item_detail_page_displays_multiple_categories()
  {
    // テスト用ユーザーを作成
    $user = User::factory()->create();

    // 商品を作成
    $item = Item::create([
      'user_id' => $user->id,
      'title' => '腕時計',
      'description' => 'スタイリッシュなデザインのメンズ腕時計',
      'price' => 15000,
      'status' => '新品',
      'image_url' => '/img/Armani+Mens+Clock.jpg',
      'is_sold' => false,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // カテゴリを作成
    $category1 = Category::create([
      'name' => 'ファッション',
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    $category2 = Category::create([
      'name' => 'アクセサリー',
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // 商品にカテゴリを関連付ける
    $item->categories()->attach([$category1->id, $category2->id]);

    // 商品詳細ページを開く
    $response = $this->get('/item/' . $item->id);

    // ステータスコードが200であることを確認
    $response->assertStatus(200);

    // 複数選択されたカテゴリが表示されていることを確認
    $response->assertSee($category1->name);
    $response->assertSee($category2->name);
  }
}

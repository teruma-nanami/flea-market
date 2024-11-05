<?php

namespace Tests\Feature\Purchase;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Item;

class PurchaseTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function user_can_complete_purchase()
  {
    // テスト用ユーザーを作成してログイン
    $seller = User::factory()->create();

    // 商品を作成
    $item = Item::create([
      'user_id' => $seller->id,
      'title' => '腕時計',
      'description' => 'スタイリッシュなデザインのメンズ腕時計',
      'price' => 15000,
      'status' => '新品',
      'image_url' => '/img/Armani+Mens+Clock.jpg',
      'is_sold' => false,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // テスト用購入者を作成してログイン
    $buyer = User::factory()->create();
    $this->actingAs($buyer);

    // 商品詳細ページを開く
    $response = $this->get('/item/' . $item->id);
    $response->assertStatus(200);

    // 購入ページに遷移
    $purchaseResponse = $this->get('/purchase/' . $item->id);
    $purchaseResponse->assertStatus(200);

    // 購入する（POSTリクエストを送信）
    $completePurchaseResponse = $this->post('/purchase/' . $item->id);
    $completePurchaseResponse->assertStatus(302); // リダイレクトされるためステータスコードを302に変更

    // 購入が完了したことを確認（itemsテーブルのis_soldカラムがtrueに更新されていることを確認）
    $this->assertDatabaseHas('items', [
      'id' => $item->id,
      'is_sold' => true,
    ]);

    // 購入完了ページにリダイレクトされることを確認
    $completePurchaseResponse->assertRedirect('/purchase/thanks'); // ここは実際のリダイレクト先に合わせて変更
  }

  /** @test */
  public function purchased_item_is_displayed_as_sold_on_listing_page()
  {
    // テスト用出品者を作成
    $seller = User::factory()->create();

    // 商品を作成
    $item = Item::create([
      'user_id' => $seller->id,
      'title' => '腕時計',
      'description' => 'スタイリッシュなデザインのメンズ腕時計',
      'price' => 15000,
      'status' => '新品',
      'image_url' => '/img/Armani+Mens+Clock.jpg',
      'is_sold' => false,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // テスト用購入者を作成してログイン
    $buyer = User::factory()->create();
    $this->actingAs($buyer);

    // 商品詳細ページを開く
    $response = $this->get('/item/' . $item->id);
    $response->assertStatus(200);

    // 購入ページに遷移
    $purchaseResponse = $this->get('/purchase/' . $item->id);
    $purchaseResponse->assertStatus(200);

    // 購入する（POSTリクエストを送信）
    $completePurchaseResponse = $this->post('/purchase/' . $item->id);
    $completePurchaseResponse->assertStatus(302); // リダイレクトされるためステータスコードを302に変更

    // 購入が完了したことを確認（itemsテーブルのis_soldカラムがtrueに更新されていることを確認）
    $this->assertDatabaseHas('items', [
      'id' => $item->id,
      'is_sold' => true,
    ]);

    // 商品一覧ページを開く
    $listingResponse = $this->get('/');
    $listingResponse->assertStatus(200);

    // 購入した商品が「SOLD」と表示されていることを確認
    $listingResponse->assertSee('<div class="item__sold"><span>SOLD</span></div>', false);
  }

  /** @test */
  public function purchased_item_is_added_to_profile_purchase_list()
  {
    // テスト用出品者を作成
    $seller = User::factory()->create();

    // 商品を作成
    $item = Item::create([
      'user_id' => $seller->id,
      'title' => '腕時計',
      'description' => 'スタイリッシュなデザインのメンズ腕時計',
      'price' => 15000,
      'status' => '新品',
      'image_url' => '/img/Armani+Mens+Clock.jpg',
      'is_sold' => false,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // テスト用購入者を作成してログイン
    $buyer = User::factory()->create();
    $this->actingAs($buyer);

    // 商品詳細ページを開く
    $response = $this->get('/item/' . $item->id);
    $response->assertStatus(200);

    // 購入ページに遷移
    $purchaseResponse = $this->get('/purchase/' . $item->id);
    $purchaseResponse->assertStatus(200);

    // 購入する（POSTリクエストを送信）
    $completePurchaseResponse = $this->post('/purchase/' . $item->id);
    $completePurchaseResponse->assertStatus(302); // リダイレクトされるためステータスコードを302に変更

    // 購入が完了したことを確認（itemsテーブルのis_soldカラムがtrueに更新されていることを確認）
    $this->assertDatabaseHas('items', [
      'id' => $item->id,
      'is_sold' => true,
    ]);

    // プロフィールページを開く
    $profileResponse = $this->get('/mypage'); // プロフィール画面のルートを確認
    $profileResponse->assertStatus(200);

    // プロフィールの購入した商品一覧に購入した商品が追加されていることを確認
    $profileResponse->assertSee($item->title);
  }
}

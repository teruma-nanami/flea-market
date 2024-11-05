<?php

namespace Tests\Feature\Item;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Item;
use App\Models\Favorite;

class LikeItemTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function user_can_like_an_item()
  {
    // テスト用ユーザーを作成してログイン
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

    // ユーザーとしてログイン
    $this->actingAs($user);

    // 商品詳細ページを開く
    $response = $this->get('/item/' . $item->id);

    // ステータスコードが200であることを確認
    $response->assertStatus(200);

    // いいねアイコンを押下する（POSTリクエストを送信）
    $likeResponse = $this->post('/items/' . $item->id . '/favorite');

    // ステータスコードが200であることを確認
    $likeResponse->assertStatus(302);

    // いいねが登録されていることを確認
    $this->assertDatabaseHas('favorites', [
      'user_id' => $user->id,
      'item_id' => $item->id,
    ]);

    // 商品詳細ページを再度開き、いいね合計値が増加していることを確認
    $response = $this->get('/item/' . $item->id);

    // いいね合計値が増加していることを確認（ここでは1と仮定）
    $response->assertSee('1');
  }

  /** @test */
  // public function like_icon_color_changes_after_liking_item()
  // {
  //   // テスト用ユーザーを作成してログイン
  //   $user = User::factory()->create();

  //   // 商品を作成
  //   $item = Item::create([
  //     'user_id' => $user->id,
  //     'title' => '腕時計',
  //     'description' => 'スタイリッシュなデザインのメンズ腕時計',
  //     'price' => 15000,
  //     'status' => '新品',
  //     'image_url' => '/img/Armani+Mens+Clock.jpg',
  //     'is_sold' => false,
  //     'created_at' => now(),
  //     'updated_at' => now(),
  //   ]);

  //   // ユーザーとしてログイン
  //   $this->actingAs($user);

  //   // 商品詳細ページを開く
  //   $response = $this->get('/item/' . $item->id);

  //   // ステータスコードが200であることを確認
  //   $response->assertStatus(200);

  //   // いいねアイコンを押下する（POSTリクエストを送信）
  //   $likeResponse = $this->post('/items/' . $item->id . '/favorite');

  //   // ステータスコードが302であることを確認
  //   $likeResponse->assertStatus(302); // リダイレクトされるためステータスコードを302に変更

  //   // いいねが登録されていることを確認
  //   $this->assertDatabaseHas('favorites', [
  //     'user_id' => $user->id,
  //     'item_id' => $item->id,
  //   ]);

  //   // 商品詳細ページを再度開く
  //   $response = $this->get('/item/' . $item->id);
  //   $response->assertStatus(200);

  //   // いいねアイコンが色変化（アクティブ状態）していることを確認
  //   $response->assertSee('<img src="/img/star-icon-active.png" alt="star-icon">', false);
  // }

  /** @test */
  public function user_can_unlike_an_item()
  {
    // テスト用ユーザーを作成してログイン
    $user = User::factory()->create();

    // 商品を作成
    $item = Item::create([
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

    // ユーザーとしてログイン
    $this->actingAs($user);

    // いいねを登録
    Favorite::create([
      'user_id' => $user->id,
      'item_id' => $item->id,
    ]);

    // 商品詳細ページを開く
    $response = $this->get('/item/' . $item->id);
    $response->assertStatus(200);

    // いいねアイコンを押下していいねを解除する（POSTリクエストを送信）
    $unlikeResponse = $this->post('/items/' . $item->id . '/favorite');
    $unlikeResponse->assertStatus(302); // リダイレクトされるためステータスコードを302に変更

    // いいねが解除されていることを確認
    $this->assertDatabaseMissing('favorites', [
      'user_id' => $user->id,
      'item_id' => $item->id,
    ]);

    // 商品詳細ページを再度開く
    $response = $this->get('/item/' . $item->id);
    $response->assertStatus(200);

    // いいね合計値が減少していることを確認（ここでは0と仮定）
    $response->assertSee('0');
  }
}

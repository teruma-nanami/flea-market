<?php

namespace Tests\Feature\Purchase;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Item;

class AddressChangeTest extends TestCase
{
  use RefreshDatabase;


  /** @test */
  public function registered_address_is_reflected_on_purchase_page()
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

    // 住所変更ページに遷移
    $addressEditResponse = $this->get('/address/edit/' . $user->id);
    $addressEditResponse->assertStatus(200);

    // 住所変更ページで住所を更新（PATCHリクエストを送信）
    $addressUpdateResponse = $this->patch('/address/update/' . $user->id, [
      'post_code' => '123-4567',
      'address' => '新しい住所',
      'building' => '新しい建物',
      'item_id' => $item->id,
    ]);
    $addressUpdateResponse->assertStatus(302); // リダイレクトされるためステータスコードを302に変更

    // 住所が更新されていることを確認
    $this->assertDatabaseHas('users', [
      'id' => $user->id,
      'post_code' => '123-4567',
      'address' => '新しい住所',
      'building' => '新しい建物',
    ]);

    // 商品購入ページを開く
    $purchaseResponse = $this->get('/purchase/' . $item->id);
    $purchaseResponse->assertStatus(200);

    // 購入ページに登録した住所が反映されていることを確認
    $purchaseResponse->assertSee('新しい住所');
  }
}

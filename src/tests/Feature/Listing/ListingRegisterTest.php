<?php

// namespace Tests\Feature\Listing;

// use Tests\TestCase;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use App\Models\User;
// use App\Models\Item;
// use App\Models\Category;

// class ItemCreationTest extends TestCase
// {
//   use RefreshDatabase;


//   /** @test */
//   public function item_can_be_created_with_required_information()
//   {
//     // テスト用ユーザーを作成してログイン
//     $user = User::factory()->create();

//     // ユーザーとしてログイン
//     $this->actingAs($user);

//     // 商品出品画面を開く
//     $response = $this->get('/items/create');
//     $response->assertStatus(200);

//     // 商品を出品（POSTリクエストを送信）
//     $itemResponse = $this->post('/items', [
//       'title' => '腕時計',
//       'description' => 'スタイリッシュなデザインのメンズ腕時計',
//       'price' => 15000,
//       'status' => '未使用に近い',
//       'image_url' => 'img/Armani+Mens+Clock.jpg', // 仮のパスを設定
//     ]);

//     $itemResponse->assertStatus(302); // リダイレクトされるためステータスコードを302に変更

//     // 商品が保存されていることを確認
//     $this->assertDatabaseHas('items', [
//       'title' => '腕時計',
//       'description' => 'スタイリッシュなデザインのメンズ腕時計',
//       'price' => 15000,
//       'status' => '未使用に近い',
//       'image_url' => 'img/Armani+Mens+Clock.jpg',
//       'user_id' => $user->id,
//       'is_sold' => false,
//     ]);
//   }
// }

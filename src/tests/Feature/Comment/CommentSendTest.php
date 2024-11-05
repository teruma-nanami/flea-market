<?php

namespace Tests\Feature\Comment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;

class CommentSendTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function logged_in_user_can_submit_comment()
	{
		// テスト用ユーザーを作成してログイン
		$user = User::factory()->create();

		// 商品を作成
		$item = Item::create([
			'user_id' => $user->id,
			'title' => '腕時計',
			'description' => 'スタイリッシュなデザインのメンズ腕時計',
			'brand' => 'Armani',
			'price' => 15000,
			'status' => '未使用に近い',
			'image_url' => '/img/Armani+Mens+Clock.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		// ユーザーとしてログイン
		$this->actingAs($user);

		// 商品詳細ページを開く
		$response = $this->get('/item/' . $item->id);
		$response->assertStatus(200);

		// コメントを送信（POSTリクエストを送信）
		$commentResponse = $this->post('/items/' . $item->id . '/comments', [
			'content' => '素晴らしい商品です！',
		]);
		$commentResponse->assertStatus(302); // リダイレクトされるためステータスコードを302に変更

		// コメントが保存されていることを確認
		$this->assertDatabaseHas('comments', [
			'user_id' => $user->id,
			'item_id' => $item->id,
			'content' => '素晴らしい商品です！',
		]);

		// 商品詳細ページを再度開く
		$response = $this->get('/item/' . $item->id);
		$response->assertStatus(200);

		// コメント数が増加していることを確認
		$response->assertSee('1');
	}
	/** @test */
	public function guest_user_cannot_submit_comment_and_is_redirected_to_login()
	{
		// テスト用ユーザーを作成
		$user = User::factory()->create();

		// 商品を作成
		$item = Item::create([
			'user_id' => $user->id,
			'title' => '腕時計',
			'description' => 'スタイリッシュなデザインのメンズ腕時計',
			'brand' => 'Armani',
			'price' => 15000,
			'status' => '未使用に近い',
			'image_url' => '/img/Armani+Mens+Clock.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		// 商品詳細ページを開く
		$response = $this->get('/item/' . $item->id);
		$response->assertStatus(200);

		// ログインしていない状態でコメントを送信しようとする（POSTリクエストを送信）
		$commentResponse = $this->post('/items/' . $item->id . '/comments', [
			'content' => '素晴らしい商品です！',
		]);

		// ログインページにリダイレクトされることを確認
		$commentResponse->assertRedirect('/login');

		// コメントが保存されていないことを確認
		$this->assertDatabaseMissing('comments', [
			'item_id' => $item->id,
			'content' => '素晴らしい商品です！',
		]);
	}

	/** @test */
	public function validation_message_is_displayed_when_comment_is_too_long()
	{
		// テスト用ユーザーを作成してログイン
		$user = User::factory()->create();

		// 商品を作成
		$item = Item::create([
			'user_id' => $user->id,
			'title' => '腕時計',
			'description' => 'スタイリッシュなデザインのメンズ腕時計',
			'brand' => 'Armani',
			'price' => 15000,
			'status' => '未使用に近い',
			'image_url' => '/img/Armani+Mens+Clock.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		// ユーザーとしてログイン
		$this->actingAs($user);

		// 256文字以上のコメントを作成
		$longComment = str_repeat('あ', 256);

		// 商品詳細ページを開く
		$response = $this->get('/item/' . $item->id);
		$response->assertStatus(200);

		// 256文字以上のコメントを送信（POSTリクエストを送信）
		$commentResponse = $this->post('/items/' . $item->id . '/comments', [
			'content' => $longComment,
		]);

		// バリデーションエラーメッセージが表示されることを確認
		$commentResponse->assertSessionHasErrors(['content' => 'contentは、255文字以下にしてください。']);
	}
}

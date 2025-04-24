<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;

class ItemSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$item1 =Item::create([
			'user_id' => 11,
			'title' => '腕時計',
			'description' => 'スタイリッシュなデザインのメンズ腕時計',
			'price' => 15000,
			'status' => '未使用に近い',
			'image_url' => '/img/Armani+Mens+Clock.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);
		$item2 =Item::create([
			'user_id' => 12,
			'title' => 'HDD',
			'description' => '高速で信頼性の高いハードディスク',
			'price' => 5000,
			'status' => '目立った傷や汚れなし',
			'image_url' => '/img/HDD+Hard+Disk.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);
		$item3 =Item::create([
			'user_id' => 13,
			'title' => '玉ねぎ3束',
			'description' => '新鮮な玉ねぎ3束のセット',
			'price' => 300,
			'status' => 'やや傷や汚れあり',
			'image_url' => '/img/iLoveIMG+d.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);
		$item4 = Item::create([
			'user_id' => 14,
			'title' => '革靴',
			'description' => 'クラシックなデザインの革靴',
			'price' => 4000,
			'status' => '状態が悪い',
			'image_url' => '/img/Leather+Shoes+Product+Photo.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);
		$item5 = Item::create([
			'user_id' => 15,
			'title' => 'ノートPC',
			'description' => '高性能なノートパソコン',
			'price' => 45000,
			'status' => '新品',
			'image_url' => '/img/Living+Room+Laptop.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);
		$item6 = Item::create([
			'user_id' => 16,
			'title' => 'マイク',
			'description' => '高音質のレコーディング用マイク',
			'price' => 8000,
			'status' => '目立った傷や汚れなし',
			'image_url' => '/img/Music+Mic+4632231.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);
		$item7 = Item::create([
			'user_id' => 17,
			'title' => 'ショルダーバッグ',
			'description' => 'おしゃれなショルダーバッグ',
			'price' => 3500,
			'status' => 'やや傷や汚れあり',
			'image_url' => '/img/Purse+fashion+pocket.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);
		$item8 = Item::create([
			'user_id' => 18,
			'title' => 'タンブラー',
			'description' => '使いやすいタンブラー',
			'price' => 500,
			'status' => '状態が悪い',
			'image_url' => '/img/Tumbler+souvenir.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);
		$item9 = Item::create([
			'user_id' => 19,
			'title' => 'コーヒーミル',
			'description' => '手動のコーヒーミル',
			'price' => 4000,
			'status' => '新品',
			'image_url' => '/img/Waitress+with+Coffee+Grinder.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);
		$item10 = Item::create([
			'user_id' => 20,
			'title' => 'メイクセット',
			'description' => '便利なメイクアップセット',
			'price' => 2500,
			'status' => '目立った傷や汚れなし',
			'image_url' => '/img/外出メイクアップセット.jpg',
			'is_sold' => false,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		$categories = Category::factory()->count(5)->create(); // アイテムを作成
		$item1->categories()->attach($categories->random(2)->pluck('id')->toArray());
		$item2->categories()->attach($categories->random(2)->pluck('id')->toArray());
		$item3->categories()->attach($categories->random(2)->pluck('id')->toArray());
		$item4->categories()->attach($categories->random(2)->pluck('id')->toArray());
		$item5->categories()->attach($categories->random(2)->pluck('id')->toArray());
		$item6->categories()->attach($categories->random(2)->pluck('id')->toArray());
		$item7->categories()->attach($categories->random(2)->pluck('id')->toArray());
		$item8->categories()->attach($categories->random(2)->pluck('id')->toArray());
		$item9->categories()->attach($categories->random(2)->pluck('id')->toArray());
		$item10->categories()->attach($categories->random(2)->pluck('id')->toArray());
	}
}

# flea-market
メルカリ風 フリマアプリ

## 作成した目的
模擬案件を通して実践に近い開発経験をつむ

## アプリケーションURL
https://flea-market.nanami-teruma.com/
fakerにて作成したパスワードはすべて「password」に統一されています

## 機能一覧
- ログイン機能
- 新規会員登録機能
- Remember Me機能
- メール認証
- パスワード再設定機能
- 商品出品
- 商品購入
- 住所登録
- 住所変更
- コメント投稿機能
- お気に入り登録/解除

## 使用技術(実行環境)

- php 7.4.9
- Laravel 8.83
- MySQL 8.0

## テーブル設計
### ユーザーテーブル
| カラム名             | データ型         | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|----------------------|------------------|-------------|------------|----------|-------------|
| ID                   | bigint unsigned  | ◯           |            | ◯        |             |
| name                 | varchar(255)     |             |            | ◯        |             |
| post_code            | varchar(255)     |             |            | ◯        |             |
| address              | varchar(255)     |             |            | ◯        |             |
| building             | varchar(255)     |             |            |          |             |
| email                | varchar(255)     |             | ◯          | ◯        |             |
| email_verified_at    | varchar(255)     |             |            |          |             |
| password             | varchar(255)     |             |            | ◯        |             |
| password_digest      | varchar(255)     |             |            | ◯        |             |
| image_url            | varchar(255)     |             |            | ◯        |             |
| remember_token       | varchar(255)     |             |            |          |             |
| created_at           | timestamp        |             |            |          |             |
| updated_at           | timestamp        |             |            |          |             |



### アイテムテーブル
| カラム名       | データ型             | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY      |
|----------------|----------------------|-------------|------------|----------|------------------|
| ID             | bigint unsigned      | ◯           |            | ◯        |                  |
| user_id        | bigint unsigned      |             |            | ◯        | ◯ (users(id))    |
| title          | varchar(255)         |             |            | ◯        |                  |
| description    | TEXT                 |             |            | ◯        |                  |
| status         | ENUM                 |             |            | ◯        |                  |
| price          | decimal(10,2)        |             |            | ◯        |                  |
| image_url      | varchar(255)         |             |            | ◯        |                  |
| is_sold        | BOOLEAN              |             |            | ◯        |                  |
| buyer_id       | bigint unsigned      |             |            | ◯        | ◯ (users(id))    |
| created_at     | timestamp            |             |            |          |                  |
| updated_at     | timestamp            |             |            |          |                  |


### カテゴリーテーブル
| カラム名    | データ型   | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
|-------------|------------|-------------|------------|----------|-------------|
| ID          | bigint     | ◯           |            | ◯        |             |
| name        | string     |             |            | ◯        |             |
| created_at  | timestamp  |             |            |          |             |
| updated_at  | timestamp  |             |            |          |             |


### コメントテーブル
| カラム名    | データ型         | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY     |
|-------------|------------------|-------------|------------|----------|-----------------|
| ID          | bigint unsigned  | ◯           |            | ◯        |                 |
| user_id     | bigint unsigned  |             |            | ◯        | ◯ (users(id))   |
| item_id     | bigint unsigned  |             |            | ◯        | ◯ (items(id))   |
| content     | TEXT             |             |            | ◯        |                 |
| created_at  | timestamp        |             |            |          |                 |
| updated_at  | timestamp        |             |            |          |                 |


### お気に入りテーブル
| お気に入り | favorites |  |  |  |  |
| --- | --- | --- | --- | --- | --- |
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| id | bigint unsigned | ◯ |  |  |  |
| user_id | bigint unsigned |  |  | ◯ | ◯ (users.id) |
| item_id | bigint unsigned |  |  | ◯ | ◯ (items.id) |
| created_at | timestamp |  |  | ◯ |  |
| updated_at | timestamp |  |  | ◯ |  |

### カテゴリーアイテムテーブル
| カラム名       | データ型   | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY          |
|----------------|------------|-------------|------------|----------|----------------------|
| ID             | bigint     | ◯           |            | ◯        |                      |
| item_id        | bigint     |             |            | ◯        | ◯ (items(id))        |
| category_id    | bigint     |             |            | ◯        | ◯ (categories(id))   |
| created_at     | timestamp  |             |            |          |                      |
| updated_at     | timestamp  |             |            |          |                      |


## ER図
![ER図](https://github.com/teruma-nanami/flea-market/blob/main/docs/diagrams/flea-market.png)

## 環境構築

### Dockerビルド

1. git clone git@github.com:teruma-nanami/flea-market
1. docker compose up -d --build

### Laravel環境構築

1. docker composer exec php bash
1. composer install
1. .env.example ファイルから.envを作成し、環境変数を変更
1. php artisan key:generate
1. php artisan migrate
1. php artisan db:seed
1. php artisan storage:link

### 単体テスト

1. php artisan test

テスト後にはシードデータがなくなってしまうため、以下のコマンドを入力してください。
1. php artisan migrate:fresh
1. php artisan db:seed

### mailhogの環境構築
.envファイルを以下のように変更してください。

```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

mailhogの起動確認についてはブラウザで http://localhost:8025 にアクセスし、MailHogのWebインターフェースが表示されることを確認します。

### RememberUserでエラーが発生したとき
Features.phpクラスにremember-usersを追加します。
vendor/laravel/fortify/src/Features.phpにあるFeaturesクラスを確認
```
    public static function rememberUsers()
    {
        return 'remember-users';
    }
```
上記を追加してください
# もぎたてフリマ（商品管理アプリ）

## 環境構築

このアプリはDocker環境上で動作します。以下は基本的な構築手順です。

```bash
# 1. リポジトリをクローン
git clone https://github.com/Kay-sep27/mogitate.git
cd リポジトリ名

# 2. Docker起動
docker compose up -d

# 3. Laravelセットアップ
docker exec -it mogitate-php-1 bash

# コンテナ内で以下を実行
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

# 4. 開発サーバ起動（必要な場合）
php artisan serve
```

## 使用技術（実行環境）

- PHP 7.4.9  
- Laravel 8.x  
- MySQL 5.7  
- Docker / Docker Compose  
- Bootstrap 5  
- フロント構成：Bladeテンプレート + CSS（共通 common.css、個別 register.css / edit.css など）

  ## ER図

![ER図](https://github.com/Kay-sep27/mogitate/blob/main/er-diagram.png?raw=true)

  ## URL一覧（ルーティング）

| 機能       | パス                           |
|------------|--------------------------------|
| 商品一覧   | http://localhost/products                                        |
| 商品詳細   | http://localhost/products/{productId}                            |
| 商品登録   | http://localhost/products/register                               |
| 商品編集   | http://localhost/products/{productId}/edit                       |
| 商品更新   | http://localhost/products/{productId}/update （※PUTメソッド）   |
| 商品削除   | http://localhost/products/{productId} （※DELETEメソッド）       |
| 商品検索   | http://localhost/products/search                                 |
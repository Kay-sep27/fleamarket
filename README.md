# Coachtech Flea Market

# 環境構築
	1.	リポジトリをクローン
git clone git@github.com:Kay-sep27/mogitate.git fleamarket
	2.	プロジェクトディレクトリへ移動
cd fleamarket
	3.	ソースコードが src/ ディレクトリ内に配置されていることを確認
	4.	Docker イメージのビルド＆起動
docker compose up -d –build
	5.	環境変数ファイルをコピー
cp src/.env.example src/.env
	6.	データベースのマイグレーション＆シーディング
docker compose exec app bash
php artisan migrate –seed
exit

使用技術
	•	PHP 8.1 / Laravel 8.83.8
	•	MySQL 8.0
	•	nginx
	•	Docker / Docker Compose
	•	Composer

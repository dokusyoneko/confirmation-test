# お問い合わせフォーム
このプロジェクトは Laravel を使ったお問い合わせフォームです。
Docker を利用してローカル環境を簡単に構築できます。



## 環境構築


###  Docker ビルド
```bash
git clone https://github.com/your-username/contact-form.git
cd contact-form
docker-compose up -d --build
※ MySQL が起動しない場合は、各PCの環境に合わせて docker-compose.yml を編集してください。

#### Laravel 初期設定
docker-compose exec php bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed

使用技術
- PHP 8.0
- Laravel 10.x
- MySQL 8.0
- Docker / Docker Compose

アクセスURL
- アプリケーション: http://localhost:8080
- phpMyAdmin: http://localhost:8081

---

## 🧩 カスタマイズポイント

- `your-username/contact-form.git` は実際のリポジトリURLに置き換えてください。
- `php artisan db:seed` の内容がある場合は、どんなダミーデータが入るかも書いておくと親切です。
- 「CSVエクスポート機能あり」「検索・絞り込み対応」など、機能一覧を追加しても良いですね。

---


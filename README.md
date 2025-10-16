# お問い合わせフォーム
このプロジェクトは Laravel を使ったお問い合わせフォームです。
Docker を利用してローカル環境を簡単に構築できます。

## 環境構築
Docker ビルド
```bash
git clone https://github.com/your-username/contact-form.git
cd contact-form
docker-compose up -d --build
※ MySQL が起動しない場合は、各PCの環境に合わせて docker-compose.yml を編集してください。

## Laravel 初期設定
1.docker-compose exec php bash
2.composer install
3.cp .env.example .env (env.exmpleをコピーして.envを作成し、環境変数を変更)
4.php artisan key:generate
5.php artisan migrate
6.php artisan db:seed

##使用技術
・ PHP 8.0
・ Laravel 10.x
・ MySQL 8.0

アクセスURL
- アプリケーション: http://localhost:80
- phpMyAdmin: http://localhost:8080

---

---


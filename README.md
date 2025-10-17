# お問い合わせフォーム
## 環境構築

**-Docker ビルド-**<br>
1.git clone https://github.com/dokusyoneko/confirmation-test.git<br>
2.docker-compose up -d --build<br>
※ MySQL が起動しない場合は、各PCの環境に合わせて docker-compose.yml を編集してください。<br>

**-Laravel 初期設定-**<br>
1.docker-compose exec php bash<br>
2.composer install<br>
3.cp .env.example .env (env.exmpleをコピーして.envを作成し、環境変数を変更)<br>
4.php artisan key:generate<br>
5.php artisan migrate<br>
6.php artisan db:seed<br>
<br>
## 使用技術
・ PHP 8.0<br>
・ Laravel 10.x<br>
・ MySQL 8.0<br>
<br>
## ER図
<img width="571" height="841" alt="index" src="https://github.com/user-attachments/assets/8365d43f-95f2-4bae-a086-a0afd0f9b2d9" />

## アクセスURL
- アプリケーション: http://localhost:80<br>
- phpMyAdmin: http://localhost:8080<br>


## 📘 勤怠管理システム（一般ユーザー + 管理者）

このプロジェクトは、一般ユーザー（スタッフ）と管理者の両方が利用できる勤怠管理システムです。

- 一般ユーザー：出勤・退勤・休憩の打刻、勤怠確認  
- 管理者：スタッフ一覧、月別勤怠一覧、勤怠詳細、CSV 出力  

---

##  使用技術
- フレームワーク	Laravel 10
- 言語	PHP 8.2
- DB	MySQL
- コンテナ	Docker / docker-compose
- テンプレート	Blade
- 認証	Laravel Auth（管理者ガード）

## 🧑‍💼 一般ユーザー（スタッフ）側の機能

### 🔐 ログイン
/login


### 🕒 勤怠打刻
- 出勤  
- 退勤  
- 休憩開始  
- 休憩終了  

### 📅 自分の勤怠一覧
- 日別勤怠  
- 月別勤怠  

---

## 🛠 管理者側の機能

### 🔐 管理者ログイン
/admin/login


### 👥 スタッフ一覧
- ID  
- 名前  
- メールアドレス  

### 📅 スタッフ別勤怠一覧
/admin/staff/{id}/attendance/{year}/{month}

### 📤 CSV 出力（FN045）
/admin/staff/{id}/attendance/{year}/{month}/csv


出力項目：

- 日付  
- 出勤  
- 退勤  
- 休憩開始  
- 休憩終了  
- 備考  

---

## 🔐 認証構成

### 一般ユーザー
- guard: `web`
- 認証: Fortify
- テーブル: `users`
- role: `"user"`

### 管理者
- guard: `admin`
- 認証: 独自実装
- テーブル: `users`
- role: `"admin"`

---

## 📂 主なディレクトリ構成
app/
└── Http/
├── Controllers/
│    ├── StaffController.php
│    └── Admin/
│         └── StaffController.php
routes/
├── web.php
└── admin.php
resources/
└── views/
├── staff/
└── admin/


---

## 🛠 セットアップ手順

### 1. クローン
git clone
cd


### 2. Docker 起動
docker compose up -d


### 3. Composer インストール
docker compose exec php composer install


### 4. .env 設定
cp.env.example.env
php artisan key:generate


### 5. マイグレーション & シーディング
php artisan migrate seed

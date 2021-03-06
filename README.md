# サイト名：ToreservE(現在停止中)

パーソナルトレーナーの為のマッチング＆予約サイト
- ユーザー：　自分に合ったトレーナーを探して予約できる。
- トレーナー：　オリジナルのプランを作成して、公開し活動できる。

# イメージ
## ユーザー
![](https://user-images.githubusercontent.com/94818659/156314096-83d1ded3-7297-4c08-9f68-1cf89718206e.png)

## トレーナー
![](https://user-images.githubusercontent.com/94818659/156369379-9ffdc64d-6b3b-4a95-97a5-2a204d94de13.png)

# サイトURL

- [ToreservE](https://toreserve.net)(ユーザー)
- [ToreservE](https://toreserve.net/trainer)(トレーナー)

# サイト説明
## トレーナー側
- 自身のオリジナルトレーニングプランを作成し、公開することが可能
- 予約があったユーザーとメッセージのやり取りができる。
- トレーニング記録を登録でき、ユーザーごとの管理が行える。

## ユーザー側
- 自分の行動エリアとトレーニングして欲しいジャンルでトレーナーを検索できる。
- 予約したトレーナーとメッセージのやり取りができる。
- トレーナーにトレーニング記録を作成してもらえ得る。

## サイトの流れ
### トレーナー
1. プロフィール登録
2. 予約を待つ
3. ユーザーから予約があれば、未承諾一覧より確認をする。
4. ユーザーに連絡をし、お互いに合意できれば、予約確定をして貰う。
5. トレーニングを行ったら、記録を作成する。

## ユーザー
1. 自分にマッチするトレーナーを見つける。
2. 予約をする。
3. トレーナーとメッセージにて詳細を決定する。
4. 記録を確認する。

# ログイン
## mail・password によるログインで利用可能
## デモログイン
- user
    - email:user1@gmail.com
    - pass:testtest
- trainer(トレーナーの画面はtop画面下部にリンクがあります。)
    - email:trainer1@gmail.com
    - pass:testtest

# ER図
![](https://user-images.githubusercontent.com/94818659/156321772-1078c1bf-ac6b-44de-9d59-8be8b1c648f4.png)


# ダウンロード
## 1.git clone
```
$ git clone https://github.com/Kento1911/ToreservE.git
$ cd ToreservE
```
## 2.envファイルの作成
```
$ cp .env.example .env 
```

## 3.キー作成及びキャッシュクリア
```
$ php artisan key:generate
$ php artisan config:clear
```

## 4.シンボリックリンクの作成とディレクトリの作成
```
$ php artisan storage:link
$ cd /storage/app/public
$ mkdir trainer
```

# 環境
* php8.0.12
* laravel8
* mysql8.0.27

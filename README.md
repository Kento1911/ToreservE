# Name（ToreservE）

パーソナルトレーナーの為のマッチング＆予約サイト

# サイトURL

[ToreservE](https://toreserve.net)

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

### ログイン
#### mail・password によるログインで利用可能
#### デモログイン
- user
    - email:user1@gmail.com
    - pass:testtest
- trainer
    - email:trainer1@gmail.com
    - pass:testtest

## ユーザー
1. 自分にマッチするトレーナーを見つける。
2. 予約をする。
3. トレーナーとメッセージにて詳細を決定する。
4. 記録を確認する。

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


# 環境
* php8.0.12
* laravel9
* mysql8.0.27

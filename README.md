### プロダクト情報共有webアプリ

### 製作者 b0021015

# ファイル

## ログイン

### login.html

ログイン画面を表示する

### login2.php 

ログインの処理をする、 

ログインに成功した場合登録されているプロダクトのデータを1件目から最大5件文のデータを取り出す

## メイン画面
### viewSelect_tpl.php 

取得したデータを表示する

### select.php メイン画面にて'前へ'又は'次へ'のボタンを押した時、

'前へ'ならば表示したプロダクトのデータより5件前のデータを取り出し、'次へ'ならば表示したデータより最大5件分後のデータを取り出す


## 検索
### serach.php 

メイン画面にて出された検索条件に合ったプロダクトの商品名と値段を表示する

## 追加
### addtion.php 

メイン画面にて'商品追加'を押された時に表示される画面

この画面にて追加するデータを入力して'決定'ボタンを押された場合,addtionexe.phpに移動し、処理を行う

### addtionexe.php 

追加処理を行い、その後addtion2.phpに移動する。

### addtion2.php

追加後の画面。

## 更新
### update.php 

メイン画面にて'更新'ボタンを押された時に表示される画面

この更新されるデータは'更新'ボタンより一つ上にあるプロダクトデータである

この画面にて現在のデータを表示して、入力した文字と違う場合に更新される

'決定'ボタンを押した場合,updateexe.phpに移動し、処理を行う

### updateexe.php 

更新処理を行い、その後update2.phpに移動する

### update2.php 

更新後の画面。


## 消去
### delete.php 

メイン画面にて'消去'ボタンを押された時に表示される画面

この時消去されるプロダクトデータの詳細を表示する

'決定'ボタンを押した場合,deleteexe.phpに移動し、処理を行う

### deleteexe.php

削除処理を行い、その後delete2.phpに移動する

### delete2.php

消去後の画面。


## 他機能

### back.php

上記の検索、追加、更新、消去での機能の画面にて表示された'戻る'ボタンの処理。

プロダクトのデータを1件目から最大5件分のデータを取り出しメイン画面に移動する



# 特徴
### 2022/08/19
更新画面にて商品の注文者ではない場合更新処理を行えない

消去画面にて商品の注文者ではない場合消去処理を行えない

メイン画面にて表示されているプロダクトデータより前にプロダクトデータがない場合'前へ'のボタンがない

メイン画面にて表示されているプロダクトデータより後にプロダクトデータがない場合一度だけ'次へ'のボタンがあり、押した場合'データがありません'と表示され'次へ'のボタンがなくなる

# 問題点
## 2022/08/19
### メイン画面
'前へ'や'次へ'の処理が一つずつしかできず、一番最初や一番最後に行く等の処理を行うボタンがない。


### 検索画面
検索にて入力した文字が含まれている文字しか検索できない。

入力せずに検索した場合全てのプロダクトデータの名前と値段が表示される。

現在、商品名でしか検索できない


### 追加画面、更新画面
空白文字を登録できる

### 共通
%や@などのASCII文字がURLエンコードになる問題を未解決

<?php
  $user_name = $_GET["user_name"];
  $user_id = $_GET["user_id"];
  $type = $_GET["products_type"];
  $products_name = $_GET["products_name"];
  $price = $_GET["price"];
  $order_date = $_GET["order_date"];
  $order_status = $_GET["order_status"];
  $order_user = $_GET["user_id"];
  $delivery_date = $_GET["delivery_date"];

  try {
    // データベースに接続
    $pdo = new PDO(
        // ホスト名、データベース名
        'mysql:host=localhost;dbname=order;charset=utf8',
        // ユーザー名
        'root',
        // パスワード
        '',
        // レコード列名をキーとして取得させる
        [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
    );

  $query = 'insert into products(type, name, price, order_date, order_status, order_user, delivery_date) values(:type, :name, :price, :order_date, :order_status, :order_user, :delivery_date)';

  $stmt = $pdo->prepare($query);


  $stmt->bindParam(':type', $type, PDO::PARAM_INT);
  $stmt->bindParam(':name', $products_name);
  $stmt->bindParam(':price', $price, PDO::PARAM_INT);
  $stmt->bindParam(':order_date', $order_date);
  $stmt->bindParam(':order_status', $order_status, PDO::PARAM_INT);
  $stmt->bindParam(':order_user', $order_user);
  $stmt->bindParam(':delivery_date', $delivery_date);

  $stmt->execute();


  } catch (PDOException $e) {

  echo 'データの追加に失敗しました';
  require_once 'addtion2.php';

    }

  echo 'データを追加しました';
  require_once 'addtion2.php';


?>


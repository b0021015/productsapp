<?php
  $user_name = $_GET["user_name"];
  $user_id = $_GET["user_id"];
  $product_id = $_GET["product_id"];

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

  $query = 'DELETE FROM products WHERE product_id = :product_id';
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetchAll();

  

 }catch (PDOException $e) {

    require_once 'exception_tpl.php';
    echo $e->getMessage();
    exit();

    }

  echo '消去を完了しました';
  require_once 'delete2.php';

?>
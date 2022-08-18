<?php
  $user_id = $_GET["user_id"];
  $start = $_GET["start"];
  $size = $_GET["size"];

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

    $query = 'SELECT * FROM user WHERE user_id = :user_id';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $result = $stmt->fetchAll();
    if(empty($result)) {
      require_once 'login.html';
    } else {
      $user_name = $result[0]["name"];
      // 5件だけ表示
      $query = 'SELECT * FROM products limit :begin, :size';
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':begin', $start, PDO::PARAM_INT);
      $stmt->bindParam(':size', $size, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll();

      require_once 'viewSelect_tpl.php';
    }

  } catch (PDOException $e) {
    // 例外が発生したら無視
#    require_once'login_tpl.php'
    require_once 'exception_tpl.php';
    echo $e->getMessage();
    exit();

    }
    ?>


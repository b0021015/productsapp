<?php
  $user_id = $_GET["user_id"];
  $password = $_GET["password"];
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

    // SQLクエリ作成 (よくない例)
    $query = 'SELECT * FROM user WHERE user_id = :user_id AND password = :password';

    // SQL文をセット
    $stmt = $pdo->prepare($query);

    // バインド
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':password', $password);

    // SQL文を実行
    $stmt->execute();

    //実行結果のフェッチ
    $result = $stmt->fetchAll();
    if(empty($result)) {
      require_once 'login.html';
    } else {
      $user_name = $result[0]["name"];
      // 5件だけ表示
      $query = 'SELECT *, products.name as products_name, user.name as user_name FROM products inner join user on products.order_user = user.user_id limit :begin, :size';
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

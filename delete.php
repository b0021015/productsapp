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


  $query = 'SELECT * FROM products where product_id = :product_id';
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetchAll();

  foreach($result as $row) {
  echo '<p>商品名:' , $row["name"], '</p>';
  echo '<p>商品の種類:';
  $query2 = 'SELECT * FROM type where type_id = :type_id';
  $stmt2 = $pdo->prepare($query2);
  $stmt2->bindParam(':type_id', $row["type"]);
  $stmt2->execute();
  $result2 = $stmt2->fetchAll();
  echo $result2[0]["name"], '</p>';
  echo '<p>値段:' , $row["price"], '</p>';
  echo '<p>注文日:' , $row["order_date"], '</p>';
  echo '<p>商品の発注状態:';
  $query3 = 'SELECT * FROM status where status_id = :status_id';
  $stmt3 = $pdo->prepare($query3);
  $stmt3->bindParam(':status_id', $row["order_status"]);
  $stmt3->execute();
  $result3 = $stmt3->fetchAll();
  echo $result3[0]["status_name"], '</p>';
  echo '<p>配達日:' , $row["delivery_date"], '</p>';
  }
  echo '<p>注文者:';
  $query4 = 'SELECT * FROM user where user_id = :user_id';
  $stmt4 = $pdo->prepare($query4);
  $stmt4->bindParam(':user_id', $row["order_user"]);
  $stmt4->execute();
  $result4 = $stmt4->fetchAll();
  echo $result4[0]["name"], '</p>';

 }catch (PDOException $e) {

    require_once 'exception_tpl.php';
    echo $e->getMessage();
    exit();

    }
?>

<?php
  $query = 'SELECT * FROM products where product_id = :product_id';
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':product_id', $product_id);
  $stmt->execute();
  $result = $stmt->fetchAll();
  if ($result[0]["order_user"] == $user_id) {
  echo '以上のデータを削除しますか?';
  echo '<p></p>';
?>
  <form action="deleteexe.php" method="get">
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="submit" name="submitBtn" value="消去">
  </form>

<?php
  } else {
  echo '登録者ではないので削除できません';
  }
?>

  <form action="back.php" method="get">
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="start" value="<?php echo 0; ?>">
    <input type="hidden" name="size" value="<?php echo 5; ?>">
    <input type="submit" name="submitBtn" value="戻る">
  </form>


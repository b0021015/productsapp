<?php
  $user_name = $_GET["user_name"];
  $user_id = $_GET["user_id"];

  echo '<label for="test">商品の情報を入力してください</label>';
  echo '<p></p>';
  try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=order;charset=utf8',
        'root',
        '',
        [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
    );

    echo '<form action="addtionexe.php" method="get">';
?>

    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

<?php
    echo '<label for="products_name">商品名を入力してください(必須) :</label>';
    echo '<input type="text" name="products_name">';
    echo '<p></p>';


    echo '<label for="products_type">商品の種類を選択してください(必須) :</label>';
    $query = 'SELECT * FROM type';
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo '<select name="products_type">';
    foreach($result as $row) {
      echo '<option value="', $row["type_id"], '">', $row["name"], '</option>';
    }
    echo '</select>';
    echo '<p></p>';


    echo '<label for="price">商品の値段を入力してください(必須) :</label>';
    echo '<input type="text" name="price">';
    echo '<p></p>';


    echo '<label for="order_date">注文日を入力してください(必須) :</label>';
    echo '<input type="date" name="order_date">';
    echo '<p></p>';


    echo '<label for="order_status">商品の発注状態を選択してください(必須) :</label>';
    $query2 = 'SELECT * FROM status';
    $stmt2 = $pdo->prepare($query2);
    $stmt2->execute();
    $result2 = $stmt2->fetchAll();
    echo '<select name="order_status">';
    foreach($result2 as $row) {
      echo '<option value="', $row["status_id"], '">', $row["status_name"], '</option>';
    }
    echo '</select>';
    echo '<p></p>';

    $timestamp = time() ;
    echo '<label for="delivery_date">配達日を入力してください :</label>';
    echo '<input type="date" name="delivery_date">';
    echo '<p></p>';

    echo '<input type="submit" name="submitBtn" value="決定">';
    echo '</form>';

  } catch (PDOException $e) {
    require_once 'exception_tpl.php';
    echo $e->getMessage();
    exit();
    }
    ?>

  <form action="back.php" method="get">
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="start" value="<?php echo 0; ?>">
    <input type="hidden" name="size" value="<?php echo 5; ?>">
    <input type="submit" name="submitBtn" value="戻る">
  </form>


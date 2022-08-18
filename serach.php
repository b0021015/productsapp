<?php
  $user_name = $_GET["user_name"];
  $user_id = $_GET["user_id"];
  $serach = $_GET["serach"];

  echo '<label for="test">検索結果</label>';
  echo '<p></p>';
  try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=order;charset=utf8',
        'root',
        '',
        [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
    );

    // ここで検索をする
    $query = 'SELECT * FROM products where name like :product';
    $stmt = $pdo->prepare($query);
    $product = '%'.$serach.'%';
    $stmt->bindParam(':product', $product);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if(empty($result)) {
        echo '商品が見つかりませんでした';
    } else {
      foreach($result as $row) {
        echo '<p>';
        echo $row["name"];
        echo ',  \\';
        echo $row["price"];
        echo '</p>';
      }
    }

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


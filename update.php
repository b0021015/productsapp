<?php
  $user_name = $_GET["user_name"];
  $user_id = $_GET["user_id"];
  $product_id = $_GET["product_id"];
  $product_name = $_GET["product_name"];
  $product_price = $_GET["product_price"];
  $order_date = $_GET["order_date"];
  $delivery_date = $_GET["delivery_date"];


  echo '<p></p>';
  try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=order;charset=utf8',
        'root',
        '',
        [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
    );

?>

    <?php
    $query = 'SELECT * FROM products where product_id = :product_id';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if ($result[0]["order_user"] == $user_id) {
    echo '更新内容を選んでください';
    ?>

    <form action="updateexe.php" method="get">

    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

    <p>
    <label for="products_name">商品名(初期値:<?php echo $product_name; ?>):</label>
    <input type="text" name="products_name" value ="<?php echo $product_name; ?>">
    </p>

    <p>
    <label for="products_type">商品の種類(初期値:) :</label>
    <?php
    $query = 'SELECT * FROM type';
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    ?>
    <select name="products_type">
    <?php 
    foreach($result as $row) {
      echo '<option value="', $row["type_id"], '">', $row["name"], '</option>';
    }
    ?>
    </select>
    </p>

    <p>
    <label for="price">値段(初期値:<?php echo $product_price; ?>) :</label>
    <input type="text" name="price" value = <?php echo $product_price; ?>>
    </p>

    <p>
    <label for="order_date">注文日(初期値:<?php echo $order_date; ?>) :</label>
    <input type="date" name="order_date" value = <?php echo $order_date; ?>>
    </p>

    <p>
    <label for="status">発注状態(初期値:) :</label>
    <?php 
    $query2 = 'SELECT * FROM status';
    $stmt2 = $pdo->prepare($query2);
    $stmt2->execute();
    $result2 = $stmt2->fetchAll();
    ?>
    <select name="order_status">
    <?php 
    foreach($result2 as $row) {
      echo '<option value="', $row["status_id"], '">', $row["status_name"], '</option>';
    }
    ?>
    </select>
    </p>

    <?php $timestamp = time();?>
    <p>
    <label for="delivery_date">配達日(初期値:<?php 
    if($delivery_date != '0000-00-00'){
    echo $delivery_date;
    } else {
    echo '登録されていません';
    }?>) :</label>
    <input type="date" name="delivery_date" value = <?php echo $delivery_date; ?>>
    </p>


    <input type="submit" name="submitBtn" value="決定">
    </form>
    <?php
    } else {
    echo '注文者ではないので更新できません';
    }
    ?>

<?php 
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


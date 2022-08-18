<?php
  $user_name = $_GET["user_name"];
  $user_id = $_GET["user_id"];
  $product_id = $_GET["product_id"];
  $type = $_GET["products_type"];
  $name = $_GET["products_name"];
  $price = $_GET["price"];
  $order_date = $_GET["order_date"];
  $order_status = $_GET["order_status"];
  $delivery_date = $_GET["delivery_date"];

  try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=order;charset=utf8',
        'root',
        '',
        [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
    );

    $query = 'select * from products where product_id = :product_id';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
    $check_type = $row["type"];
    $check_name = $row["name"];
    $check_price = $row["price"];
    $check_order = $row["order_date"];
    $check_status = $row["order_status"];
    $check_delivery = $row["delivery_date"];
    }

    $query2 = 'update products set type = :type, name = :name, price = :price, order_date = :order_date, order_status = :order_status, delivery_date = :delivery_date where product_id = :product_id';

    $stmt = $pdo->prepare($query2);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $order_date2 = "'".$order_date."'";
    $stmt->bindParam(':order_date', $order_date2);
    $stmt->bindParam(':order_status', $order_status);
    $delivery = "'".$delivery_date."'";
    $stmt->bindParam(':delivery_date', $delivery);
    $stmt->bindParam(':product_id', $product_id);

    $stmt->execute();

  } catch (PDOException $e) {
//    require_once 'exception_tpl.php';
    echo $e->getMessage();
    exit();

    }

  echo 'XV‚ðŠ®—¹‚µ‚Ü‚µ‚½';
  require_once 'update2.php';

?>

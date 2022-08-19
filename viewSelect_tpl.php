<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <title></title>
</head>
<body>
<p>ようこそ <?php echo $user_name; ?> さん</p>
  <form action="serach.php" method="get">
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <label for="serach">商品検索 :</label>
    <input type="text" name="serach">
    <input type="submit" name="submitBtn" value="商品検索">
  </form>
  

  <form action="addtion.php" method="get">
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="submit" name="additon" value="商品追加">
  </form>

<?php
    if ($result){
  $count = $start + 1;
  foreach($result as $row) {
    echo '<p>';
    echo $count;
    echo',  ';
    echo $row["products_name"];
    echo ',  \\';
    echo $row["price"];
    echo '<br>';
    echo '注文者:';
    echo $row["user_name"];
    echo '</p>';


?>

    <form action="update.php" method="get">
        <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
        <input type="hidden" name="product_name" value="<?php echo $row["name"]; ?>">
        <input type="hidden" name="product_price" value="<?php echo $row["price"]; ?>">
        <input type="hidden" name="order_date" value="<?php echo $row["order_date"]; ?>">
        <input type="hidden" name="delivery_date" value="<?php echo $row["delivery_date"]; ?>">
        <input type="submit" name="submitBtn" value="更新">
    </form>

    <form action="delete.php" method="get">
        <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
        <input type="submit" name="delete" value="商品削除">
    </form>

<?php

    echo '</p>';
    $count++;
    }
  } else {
    echo 'データがありません';
  }
?>



<p></p>

  <form action="select.php" method="get">
<?php
  if ($start > 0) {
?>
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="start" value="
<?php
  $next = $start - 5;
  if ($next < 0) {
      $next = 0;
  }
  echo $next;
?>
    ">
    <input type="hidden" name="size" value="<?php echo $size; ?>">
    <input type="submit" name="submitBtn" value="前へ">
<?php
  }
?>
  </form>

  <form action="select.php" method="get">
<?php
  if ($result) {
?>
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="start" value="
<?php
  $next = $start;
  if ($result){
    $next = $next + 5;
  }
  echo $next;
?>
    ">
    <input type="hidden" name="size" value="<?php echo $size; ?>">
    <input type="submit" name="submitBtn" value="次へ">
<?php
  }
?>
  </form>


</body>
</html>

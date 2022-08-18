<?php 
  $user_name = $_GET["user_name"];
  $user_id = $_GET["user_id"];

?>

  <form action="back.php" method="get">
    <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="start" value="<?php echo 0; ?>">
    <input type="hidden" name="size" value="<?php echo 5; ?>">
    <input type="submit" name="submitBtn" value="戻る">
  </form>

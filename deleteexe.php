<?php
  $user_name = $_GET["user_name"];
  $user_id = $_GET["user_id"];
  $product_id = $_GET["product_id"];

  try {
    // �f�[�^�x�[�X�ɐڑ�
    $pdo = new PDO(
        // �z�X�g���A�f�[�^�x�[�X��
        'mysql:host=localhost;dbname=order;charset=utf8',
        // ���[�U�[��
        'root',
        // �p�X���[�h
        '',
        // ���R�[�h�񖼂��L�[�Ƃ��Ď擾������
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

  echo '�������������܂���';
  require_once 'delete2.php';

?>
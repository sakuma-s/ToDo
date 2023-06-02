<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
require 'db_connection.php';

if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $edit = $_POST['edit'];

  try{
    $sql = 'UPDATE list SET todolist = :todolist WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':todolist', $edit, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: index.php');
    exit;
  } catch (PDOException $e) {
    echo 'エラーが発生しました' . $e->getMessage();
  }
}
?>

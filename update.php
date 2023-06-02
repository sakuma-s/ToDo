<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
require 'db_connection.php';

if (isset($_POST['btn_update'])) {
    $id = $_POST['id'];
    $todolist = $_POST['todolist'];
  try{
    $sql = 'UPDATE list SET todolist = :todolist WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':todolist', $todolist, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute(array(':todolist' => $todolist,':id' => $id));
    header('Location: index.php');
    exit;

  } catch (PDOexception $e) {
    echo 'エラーが発生しました' . $e->getMessage();
  }
}

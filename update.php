<?php
require 'db_connection.php';

if (isset($_POST['btn_update'])) {
    $id = $_POST['id'];
    $todolist = $_POST['todolist'];

    $sql = 'UPDATE list SET todolist = :todolist WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':todolist', $todolist, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: index.php');
    exit;
}

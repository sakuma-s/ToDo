<?php
require 'db_connection.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM list WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);//結果の取得
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <label for="todolist">今日</label>
        <textarea id="todolist" type="text" name="todolist" cols="40"><?php echo htmlspecialchars($row['todolist']); ?></textarea>
        <p><input type="submit" name="btn_update" value="更新する"></p>
        <a href="index.php">戻る</a>
    </form>
</body>
</html>

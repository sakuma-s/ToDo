<?php
header('X-FRAME-OPTIONS:DENY');
$total_pages = "";
require 'db_connection.php';
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
//GETで現在のページ数を取得する（未入力の場合は1を挿入）
if (isset($_GET['page'])) {
  $page = (int)$_GET['page'];
} else {
  $page = 1;
}
var_dump($page);
//スタート
if($page > 1) {
  $start = ($page * 5) - 5;
} else {
  $start = 0;
}

$stmt = $pdo->prepare("SELECT * FROM list ORDER BY id DESC LIMIT 0,5");
$stmt->execute();

if (!$stmt) {
  die($pdo->$error);
}
// $page = filter_input(INPUT_GET, 'page',FILTER_SANITIZE_NUMBER_INT);
// $start = ($page - 1) * 5;
// //データの取得
// $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ToDo</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container">
      <header>
        <h1>todolist</h1>
      </header>
      <form action="" method = "post">
      <label for="todolist">今日</label>
      <textarea id="todolist" type="text" name="todolist" cols="40">
      </textarea>
      <p><input type="submit" name="btn_record" value="登録する"></p>
    </div>
      <table>
        <?php $results = $stmt->fetchAll(); ?>
        <?php foreach ($results as $row) : ?>
        <tr>
          <tb><?php echo h($row['todolist']) . "<br>"; ?></tb>
          <tb><a href="edit.php?id=<?php echo h($row['id']); ?>">編集</a></tb>
        </tr>
        <tr>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="submit" name="delete" value="削除">
        </tr>
        </form>
        <?php endforeach; ?>
        </table>

    <!-- <script>
      var today = new Date();
      var todayHtml = today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
      document.write('<p class="date">' + todayHtml + '</p>');
    </script> -->
    <div>
    </div>
  </body>

</html>

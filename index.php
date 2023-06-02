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
//スタート地点の数を作成
if($page > 1) {
  $start = ($page * 5) - 5;// 例：２ページ目の場合は、『(2 × 5) - 5 = 5』
} else {
  $start = 0;
}

$stmt = $pdo->prepare("SELECT * FROM list ORDER BY id DESC LIMIT {$start},5");
// var_dump($start);
$stmt->execute();

if (!$stmt) {
  die($pdo->$error);
}
//テーブルのデータ件数取得
$page_num = $pdo->prepare("SELECT COUNT(*) id FROM list");
$page_num->execute();
$page_num = $page_num->fetchColumn();
// var_dump($page_num);

// ページネーションの数を取得する
$pagination = ceil($page_num / 5);
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
      <form action="index.php" method="post">
      <label for="todolist">今日</label>
      <textarea id="todolist" type="text" name="todolist" cols="40"></textarea>
      <p><input type="submit" name="btn_record" value="登録する"></p>
      </form>
    </div>
      <table>
        <form action="index.php" method="post">
      <?php $results = $stmt->fetchAll(); ?>
        <?php foreach ($results as $row) : ?>
          <?php echo h($row['todolist']) . "<br>"; ?>
          <a href="edit.php?id=<?php echo h($row['id']); ?>">編集</a>
        <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
        <input type="submit" name="delete" value="削除">
        </form>
        <?php endforeach; ?>
        </table>
        <?php for ($i=1; $i <= $pagination ; $i++) :?>
	      <a href="?page=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    <!-- <script>
      var today = new Date();
      var todayHtml = today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
      document.write('<p class="date">' + todayHtml + '</p>');
    </script> -->
  </body>

</html>

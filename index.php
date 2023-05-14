<?php
header('X-FRAME-OPTIONS:DENY');
require 'db_connection.php';
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

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
      </form>
    </div>
    <table>
      <?php $results = $stmt->fetchAll(); ?>
      <?php foreach ($results as $row) : ?>
      <tr>
        <tb><?php echo h($row['todolist']) . "<br>"; ?></tb>
      </tr>
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

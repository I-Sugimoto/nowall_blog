<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];

$dbh = connectDb(); //関数名を統一すること
$sql = "select * from posts where id = :id ";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);

// 存在しないidを渡された場合はindex.phpへ飛ばす
if (!$post) {
  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Blog</title>
</head>
<body>
  <h1><?php echo h($post['title']) ?></h1>
  <a href="index.php">戻る</a>
  <li style="list-style-type: none;">
    [#<?php echo h($post['id']) ?>]
    @<?php echo h($post['title']) ?><br>
    <?php echo h($post['body']) ?><br>
    <a href="edit.php?id=<?php echo h($post['id']) ?>">[編集]</a>
    <a href="delete.php?id=<?php echo h($post['id']) ?>">[削除]</a>
    投稿日時: <?php echo h($post['created_at']) ?>
    <hr>
  </li>
</body>
</html>
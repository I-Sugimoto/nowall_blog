<?php

// 設定ファイルと関数ファイルを読み込む
require_once('config.php');
require_once('functions.php');

// DBに接続
$dbh = connectDb(); // 特にエラー表示がなければOK

// レコードの取得
// 'order by updated_at desc':「更新日時が新しい順」という意味(キャンプより引用)
$sql = "select * from posts order by updated_at desc";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Blog</title>
</head>
<body>
<h1>Blog</h1>
<a href="add.php">新規記事投稿</a>
<h1>記事一覧</h1>
  <?php foreach ($posts as $post ) : ?>
    <li style = "list-style-type : none;">
      <a href="show.php?id=<?php echo h($post['id']) ?>"><?php echo h($post['title']) ?></a><br>
      <?php echo h($post['body']) ?><br>
      投稿日時: <?php echo h($post['updated_at']) ?>
      <hr>
    </li>
  <?php endforeach; ?>
</body>
</html>
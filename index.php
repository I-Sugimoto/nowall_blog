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
// 新規タスク追加
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // フォームに入力されたデータの受け取り
    $title = $_POST['title'];

    // エラーチェック用の配列
    $errors = array();

    // バリデーション
    if ($title == '') {
        $errors['title'] = 'タスク名を入力してください';
    }

    if (empty($errors)) {
        $dbh = connectDb();

        $sql = "insert into tasks (title, created_at, updated_at) values (:title, now(), now())";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->execute();

        // index.phpに戻る
        header('Location: index.php');
        exit;
    }
}
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
      <?php echo h($post['title']) ?><br>
      <?php echo h($post['body']) ?><br>
      投稿日時: <?php echo h($post['updated_at']) ?>
      <hr>
    </li>
  <?php endforeach; ?>
</body>
</html>
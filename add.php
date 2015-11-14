<?php

// 設定ファイルと関数ファイルを読み込む
require_once('config.php');
require_once('functions.php');

//バリデーションの追加
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // フォームに入力されたデータの受け取り
    $body = $_POST['body'];
    $title = $_POST['title'];

    // エラーチェック用の配列
    $errors = array();

    // バリデーション
    if ($title == '') {
        $errors['title'] = 'タイトルが未入力です';
    }

    if ($body == '') {
        $errors['body'] = 'メッセージが未入力です';
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
  <title>新規記事投稿</title>
</head>
<body>
  <h1>新規記事投稿</h1>
  <p><a href="index.php">戻る</a></p>
  <form action="" method="post">
    <p>
      タイトル<br>
      <input type="text" name="title">
    </p>
    <p>
      本文<br>
      <textarea name="body" cols="30" rows="5"></textarea>
    </p>
    <p><input type="submit" value="投稿する"></p>
  </form>
</body>
</html>
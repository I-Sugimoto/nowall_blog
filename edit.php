<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];


$dbh = connectDb(); //関数名を統一すること
$sql = "select * from posts where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);

// 存在しないidを指定された場合はindex.phpに飛ばす
if (!$post) {
  header('Location: index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $body = $_POST['body'];
  $title = $_POST['title'];
  $errors = array();

  // バリデーション
  if ($title == '') {
    $errors['title'] = 'タイトルが未入力です';
  }

  if ($body == '') {
    $errors['body'] = 'メッセージが未入力です';
  }

  // バリデーション突破後
  if (empty($errors)) {
   $dbh = connectDb(); //関数名を統一すること
   $sql = "update posts set title = :title, body = :body, updated_at = now()
            where id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":body", $body);
    $stmt->execute();

    header('Location: index.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>編集画面</title>
</head>
<body>
  <h1>投稿内容を編集する</h1>
  <p><a href="index.php">戻る</a></p>
  <form action="" method="post">
    <p>
      タイトル<br>
      <input type="text" name="title" value="<?php echo h($post['title']); ?>">
    </p>
    <p>
      本文<br>
      <textarea name="body" cols="30" rows="5"><?php echo h($post['body']) ?></textarea>
    </p>
    <p><input type="submit" value="編集する"></p>
  </form>
</body>
</html>

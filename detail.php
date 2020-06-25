<?php

// detail.phpは...
// 詳細ページの表示をするためのファイル

// 以下の方法でdbc.phpの関数をこちらでも使えるようになる
require_once('blog.php');

$blog = new Blog();

// 詳細ページでidを受け取る
// PHPの$_GETでidを取得
  // $id = $_GET['id'];
$result = $blog->getById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブログ詳細</title>
</head>
<body>
  <h2>ブログ詳細</h2>
  <h3>タイトル：<?php echo $result['title'] ?></h3>
  <p>投稿日時：<?php echo $result['post_at'] ?></p>
  <p>カテゴリ：<?php echo $blog->setCategoryName($result['category']) ?></p>
  <hr>
  <p>本文：<?php echo $result['content'] ?></p>
  <p><a href="/">戻る</a></p>
</body>
</html>
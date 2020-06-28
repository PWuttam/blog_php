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
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>ブログ詳細</title>
</head>
<body>
    <!-- ヘッダーのナビゲーションバー -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">シンプルブログ</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/form.html">執筆</a>
          </li>
        </ul>
      </div>
    </nav>


  <div class="container">
    <h2>ブログ詳細</h2>
    <h3>タイトル：<?php echo $result['title'] ?></h3>
    <p>投稿日時：<?php echo $result['post_at'] ?></p>
    <p>カテゴリ：<?php echo $blog->setCategoryName($result['category']) ?></p>
    <hr>
    <p>本文：<?php echo $result['content'] ?></p>
    <p><a href="/">戻る</a></p>
  </div>
  
</body>
</html>
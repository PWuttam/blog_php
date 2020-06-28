<?php

require_once('blog.php');

$blog = new Blog();
$result = $blog->getById($_GET['id']);

$id = $result['id'];
$title = $result['title'];
$content = $result['content'];
$category = (int)$result['category'];
$publish_status = (int)$result['publish_status'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>BlogUpdateForm</title>
</head>
<body>

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
    <h2>ブログ更新フォーム</h2>
    <form action="blog_update.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <p>ブログタイトル:</p>
      <!-- 既存のデータを入れたい場合はvalue -->
      <input type="text" name="title" value="<?php echo $title ?>">
      <p>ブログ本文:</p>
      <textarea name="content" id="content" cols="30" rows="10"><?php echo $content ?></textarea>
      <br>
      <p>カテゴリ：</p>
      <select name="category">
        <option value="1" <?php if($category === 1) echo "selected" ?>>雑談</option>
        <option value="2" <?php if($category === 2) echo "selected" ?>>プログラミング</option>
        <option value="3" <?php if($category === 3) echo "selected" ?>>バイク</option>
      </select>
      <br>
      <input type="radio" name="publish_status" value="1" <?php if($publish_status === 1) echo "checked" ?>>公開
      <input type="radio" name="publish_status" value="2" <?php if($publish_status === 2) echo "checked" ?>>非公開
      <br>
      <input type="submit" value="送信">
    </form>
    <p><a href="/">戻る</a></p>
  </div>
</body>
</html>
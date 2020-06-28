<?php

require_once('blog.php');

$blog = new Blog();

// 取得したデータを表示
$blogDate = $blog->getAll();

// 悪意のあるコードの埋め込みを防ぐ
// 長いので h という関数にしている
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>ブログ一覧</title>
</head>
<style>
  div.container-m {
    margin-top: 40px;
  }
</style>
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

  <!-- メインコンテンツ -->
  <div class="container container-m">
    <div class="card">
        <h2 class="card-header">ブログ一覧</h2>
        <div class="card-body">
          <p><a href="/form.html">新規作成</a></p>
          <table>
            <tr>
              <th>タイトル</th>
              <th>カテゴリ</th>
              <th>投稿日時</th>
            </tr>
            <?php foreach($blogDate as $column): ?>
            <tr>
              <td><?php echo h($column['title']) ?></td>
              <td><?php echo h($blog->setCategoryName($column['category'])) ?></td>
              <td><?php echo h($column['post_at']) ?></td>
              <!-- GETリクエストでidをURLにつけて送る -->
              <td><a href="/detail.php?id=<?php echo $column['id'] ?>">詳細</a></td>
              <td><a href="/update_form.php?id=<?php echo $column['id'] ?>">編集</a></td>
              <td><a href="/blog_delete.php?id=<?php echo $column['id'] ?>">削除</a></td>
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
    </div>
  </div>
  
</body>
</html>
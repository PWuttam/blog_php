<?php

// 変数
  const ID = 1;
  $title = "シンプルブログ";
  $content = 'PHPを使ったブログの本文です。';
  $post_at = '2020/June/09';
  $tag = ['php', 'プログラミング', 'ブログ'];
  $status = true; // 公開 // 非公開 false

  const ID2 = 2;
  $title2 = "アクションがたくさん詰まったブログ";
  $content2 = '色々な言語を使ったブログの本文です。';
  $post_at2 = '2020/June/09';
  $tag2 = ['複数言語', 'プログラミング', 'ブログ'];
  $status2 = true; // 公開 // 非公開 false

  $blog1 = array(
    'id' => ID,
    'title' => $title,
    'content' => $content,
    'post_at' => $post_at,
    'tag' => $tag,
    'status' => $status
  );

  $blog2 = [
    'id2' => ID2,
    'title2' => $title2,
    'content2' => $content2,
    'post_at2' => $post_at2,
    'tag2' => $tag2,
    'status2' => $status2
  ];

  $blogs = [$blog1, $blog2];

  // echo '<pre>';
  // var_dump($blogs);
  // echo '</pre>';

  // ①バリュー（中身）のみの出力
  // foreach($blog1 as $blog) {
  //   echo '<pre>';
  //     echo $blog;
  //   echo '</pre>';
  // };

  // ②キーとバリューを出力
  // foreach($blog2 as $key => $value) {
  //   echo '<pre>';
  //     echo $key . '=' . $value;
  //   echo '</pre>';
  // };

  // 多次元配列
  foreach($blogs as $blog) {
    foreach($blog as $value) {
      echo '<pre>';
        echo $value;
      echo '</pre>';
    }
  };

?>
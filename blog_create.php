<?php

require_once('blog.php');

$blogs = $_POST;

// インスタンス化
$blog = new Blog();
$blog->blogValidate($blogs);
$blog->blogCreate($blogs);

?>
<p><a href="/">戻る</a></p>
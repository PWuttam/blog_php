<?php
session_start();
require_once '../classes/UserLogic.php';
// hを読み込むために下記を記述
require_once '../functions.php';

// ログインしているか判定
// していなかったら新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください!';
  header('Location: signup_form.php');
  return;
}

$login_user = $_SESSION['login_user'];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
</head>
<body>
  <h2>マイページ</h2>
  <p>ログインユーザ:<?php echo h($login_user['name']) ?></p>
  <p>メールアドレス:<?php echo h($login_user['email']) ?></p>
  <a href="../index.php">ブログ一覧へ</a><br>
  <br>
  <a href="./login.php">ログアウト</a>
  
</body>
</html>
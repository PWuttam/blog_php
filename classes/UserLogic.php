<?php

// .. 一個上の階層
require_once '../dbconnect.php';

class UserLogic
{
  /**
   * ユーザを登録する
   * @param array $userDate
   * @return bool $result
   */
  public static function createUser($userDate)
  {
    //最初にfalseに設定
    $result = false;

    $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?) ';

    // ユーザデータを配列に入れる
      // VALUESの?
    $arr = [];
    $arr[] = $userDate['username'];
    $arr[] = $userDate['email'];
    $arr[] = password_hash($userDate['password'], PASSWORD_DEFAULT);

    // 例外処理
    try {
      // データベースにコネクトする
        // dbconnect.phpの呼び出し
        // sqlの準備
      $stmt   = connect()->prepare($sql);
      $result = $stmt->execute($arr);
      return $result;
    } catch(\Exeption $e) {
      return $result;
    }
  }

  /**
   * ログイン処理
   * @param string $email
   * @param string $password
   * @return bool $result
   */
  public static function login($email, $password)
  {
    // 結果
    $result = false;
    // ユーザをemailから検索して取得
    $user = self::getUserByEmail($email);

    if (!$user) {
      $_SESSION['msg'] = 'emailが一致しません。';
      return $result;
    }

    // パスワードの照会
    if (password_verify($password, $user['password'])) {
      // ログイン成功
      session_regenerate_id(true);
      $_SESSION['login_user'] = $user;
      $result = true;
      return $result;
    }
    
    $_SESSION['msg'] = 'パスワードが一致しません。';
    return $result;
  }

  /**
   * emailからユーザを取得
   * @param string $email
   * @return array|bool $user|false
   */
  public static function getUserByEmail($email)
  {
    // SQLの準備
    // SQLの実行
    // SQLの結果を返す

    $sql = 'SELECT * FROM users WHERE email = ?';

    // emailを配列に入れる
    $arr = [];
    $arr[] = $email;

    try {
      $stmt   = connect()->prepare($sql);
      $stmt->execute($arr);
      // SQLの結果を返す
      $user = $stmt->fetch();
      return $user;
    } catch(\Exeption $e) {
      return false;
    }
  }

  /**
   * ログインチェック
   * @param void
   * @return bool $result
   */
  public static function checkLogin()
  {
    $result = false;

    // セッションにログインユーザが入っていなかったらfalse
    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result = true;
    }

    return $result;
  }

  /**
   * ログアウト処理
   */
  public static function logout()
  {
    // セッション変数を全て解除する
    $_SESSION = array();
    // 最終的に、セッションを破壊する
    session_destroy();
  }

}
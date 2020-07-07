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
}
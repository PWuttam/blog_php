<?php

require_once('env.php');

Class Dbc
{
  protected $table_name;

  // 1.データベースへの接続
      // 引数：なし
      // 返り値：接続結果を返す（エラーも返す）
  protected function dbConnect() {
      // Data Source Name データベースに接続するために必要な情報
          // 頭にデータベースの種類を指定して : で区切る．
          // 各項目は 項目名=値 とし， ; で区切る．
      $host   = DB_HOST;
      $dbname = DB_NAME;
      $user   = DB_USER;
      $pass   = DB_PASS;
      $dsn    = "mysql:host=$host;dbname=$dbname;charset=utf8";

      // DBのエラーをチェックできる構文
          // 例外処理とも言われる
          // try〜catch
      try {
        // PDO::ATTR_ERRMODE
          // SQL実行でエラーが起こった際にどう処理するかを指定
          // デフォルトは PDO::ERRMODE_SILENT．
          // PDO::ERRMODE_EXCEPTION を設定すると例外をスロー．一番無難．
          $dbh = new PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          ]);
      } catch(PDOException $e) {
          echo '接続失敗'. $e->getMessage();
          exit();
      };

      return $dbh;
  }

  // 2.データを取得する
      // 引数：なし
      // 返り値：取得したデータ
  public function getAll() {
      // クラス内で別のfuncrionを参照しているので$this->を入れる
      $dbh = $this->dbConnect();

      // ①SQLの準備
        // ダブルコーテーションでないと展開できない
      $sql = "SELECT * FROM $this->table_name";
      // ②SQLの実行
      $stmt = $dbh->query($sql);
      // ③sqlの結果を受け取る
      $result = $stmt->fetchall(\PDO::FETCH_ASSOC);

      return $result;
      $dbh = null;
  }

  // 引数：$id
  // 返り値：$result
  public function getById($id) {
    // idが空の場合
    if(empty($id)) {
      exit('IDが不正です。');
    }

    $dbh = $this->dbConnect();

    // SQLの準備
    $stmt = $dbh->prepare("SELECT * FROM $this->table_name Where id = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    // SQLの実行
    $stmt->execute();
    // 結果を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$result) {
      exit('ブログがありません。');
    }

    return $result;
  }

  // 削除機能に関して共通で使えるので dbc.php に
  public function delete($id) {
        // idが空の場合
        if(empty($id)) {
          exit('IDが不正です。');
        }
    
        $dbh = $this->dbConnect();
    
        // SQLの準備
        $stmt = $dbh->prepare("DELETE FROM $this->table_name Where id = :id");
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        // SQLの実行
        $stmt->execute();
        echo 'ブログを削除しました！';
        return $result;
  }
}

?>
<?php

require_once('dbc.php');

// dbc.phpの中で共通化できないものがここに
Class Blog extends Dbc
{
  protected $table_name = 'blog';
  // ③.カテゴリー名を表示
       // 引数：数字
       // 返り値：カテゴリーの文字列
       // 静的な部分なので共通で使えるという意味のstaticにしても良い
  public function setCategoryName($category) {
        if($category === '1'){
          return '雑談';
        } elseif ($category === '2') {
          return 'プログラミング';
        } elseif ($category === '3') {
          return 'バイク';
        } else {
          return 'その他';
        }
  }

  function blogCreate($blogs) {
    // SQL文の準備
    $sql = "INSERT INTO
      $this->table_name(title, content, category, publish_status)
    VALUES
      (:title, :content, :category, :publish_status)";

    // プリペアで準備
    // まずrequire_once('dbc.php');を記述
    $dbh = $this->dbConnect();

    $dbh->beginTransaction(); // トランザクションを返す①

    // エラーが起きやすいのでtryとcatchで
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
      $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
      $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
      $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
      // 上記の表示
      $stmt->execute();
      $dbh->commit(); // トランザクション②コミットしてあげる
      echo 'ブログを投稿しました！';
    } catch(PDOException $e) {
      $dbh->rollBack(); // トランザクション③エラーになったときロールバック
      exit($e);
    }
  }

  public function blogUpdate($blogs) {
      // SQL文の準備
        // UPDATE 表名
        // SET    列名 = 値 
        // WHERE  更新する行を特定する条件;
      $sql = "UPDATE $this->table_name SET
                title = :title, content = :content, category = :category, publish_status = :publish_status
              WHERE
                id = :id";
  
      // プリペアで準備
      // まずrequire_once('dbc.php');を記述
      $dbh = $this->dbConnect();
  
      $dbh->beginTransaction(); // トランザクションを返す①
  
      // エラーが起きやすいのでtryとcatchで
      try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
        $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
        $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
        $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
        // idも追加
        $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT);
        // 上記の表示
        $stmt->execute();
        $dbh->commit(); // トランザクション②コミットしてあげる
        echo 'ブログを「更新」しました！';
      } catch(PDOException $e) {
        $dbh->rollBack(); // トランザクション③エラーになったときロールバック
        exit($e);
      }
  }

  // ブログのバリデーション
  public function blogValidate($blogs) {
    // empty関数 未入力チェックに
    // exitで
    if (empty($blogs['title'])) {
      exit('タイトルを入力してください');
    }
  
    // mb_strlen 文字数の長さチェック
    if (mb_strlen($blogs['title']) > 191) {
      exit('タイトルは191文字以下にしてください');
    }
  
    if (empty($blogs['content'])) {
      exit('本文を入力してください');
    }
  
    if (empty($blogs['category'])) {
      exit('カテゴリーは必須です');
    }
  
    if (empty($blogs['publish_status'])) {
      exit('公開ステータスは必須です');
    }
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
      <meta charset="UTF-8">
      <title>セブ掲示版</title>

  </head>
  <body>

  <?php

  //POST送信が行われたら、下記の処理を実行
  //var_dump($_POST);
  if(isset($_POST) && !empty($_POST)){
    //テストコメント

    $dsn ='mysql:dbname=oneline_bbs;host=localhost';
    $User ='root';
    $password ='';
    $dbh = new PDO($dsn,$User,$password);
    $dbh->query('SET NAMES utf8');

    $sql = 'INSERT INTO `oneline_bbs`.`posts` (`id`, `nickname`, `comment`, `created`) VALUES (NULL, "'.$nickname.'", "'.$comment.'", now());';
    $stmt = $dbh->prepare($sql);
    // insert文実行
    $stmt->execute();

    //実行結果として得られたデータを表示
    
    
    while(1)
    {
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      if($rec==false)
      {
        break;
      }
      echo $rec['id'];
      echo $rec['nickname'];
      echo $rec['comment'];
    $nickname = $_POST['nickname'];
    $comment = $_POST['comment'];

    //SQL文作成
      echo $rec['created'];
      echo'<br />'; 
    }

    $dbh = null;

  }
    ?>

<form action="bbs.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>

    <h2><a href="#">nickname Kenichi</a> <span>2015-12-02 10:10:20</span></h2>
    <p>つぶやきコメント</p>

    <h2><a href="#">nickname Kenichi</a> <span>2015-12-02 10:10:10</span></h2>
    <p>つぶやきコメント2</p>

</body>
</html>
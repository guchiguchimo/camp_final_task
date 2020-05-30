<!-- php（DBと連携） -->
<?php
//1.  DB接続します xxxにDB名を入れます
try {

$edit_id = $_POST["id"];

$pdo = new PDO('mysql:dbname=stork_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM temperature_table WHERE id=$edit_id"); 
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループ $resultの中に「カラム名」が入ってくるのでそれを表示
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $edit_date = $result["date"];
      $edit_temperature = $result["temperature"];
  }

}
?>

<!-- html, js -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <!-- CSS -->
  <link rel="stylesheet" href="../css/style.css" />
　<title>基礎体温の推移</title>
</head>
<body>
    <div class="wrap">
        <!-- ヘッダー -->
        <header>
            <div class="header">
            <a href="index.html" class="main_icon"
            ><img src="../img/stork.png" alt="コウノトリ"
            /></a>
            <a href="index.html" class="main_title">
            <p class="title">S-tallk ～これからの話について～</p>
            </a>
            <div class="menu-btn">
            <img src="../img/hamburger.png" alt="ハンバーガーメニュー" />
            <div class="menu">
            <div class="menu__item">TOP</div>
            <div class="menu__item">ABOUT</div>
            <div class="menu__item">BLOG</div>
            <div class="menu__item">CONTACT</div>
            </div>
            </div>
            </div>
        </header>
        <!-- ヘッダー -->

        <!-- 入力箇所 -->
              <form method="post" action="php/insert.php" class="daily_record">
                <!-- 日付の入力 -->
                <p class="small_title"><span class="emphasis">●日付</span></p>
                <div class="small_input">
                  <input
                    type="date"
                    id="date_input"
                    class="date_input"
                    name="date"
                    placeholder="Date"
                    value="<?php echo $edit_date;?>"
                    required
                  />
                </div>
                <!-- 日付の入力 -->

                <!-- 体温の入力 -->
                <p class="small_title">
                  <span class="emphasis">●体温</span
                  >（※半角数字で小数点第一位まで入力）
                </p>
                <div class="small_input">
                  <input
                    type="temperature"
                    id="temperature_input"
                    class="temperature_input"
                    name="temperature"
                    value="<?php echo $edit_temperature;?>"
                    required
                  />
                  <div>℃</div>
                </div>
                <!-- 体温の入力 -->

                <!-- 記録ボタン -->
                <div class="submit_container">
                  <input type="submit" class="record_button" value="記録" />
                </div>
                <!-- 記録ボタン -->
              </form>
        </div>
        <!-- 入力箇所 -->

        <!-- フッター -->
        <footer class="footer text-center">
            <div class="wrapper">
            <small class="copyrights"
            >&copy;Copyright 2020 MOTONOBU SAKAGUCHI All rIghts reserved.
            </small>
            </div>
        </footer>
        <!-- フッター -->
    </div>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- jsファイル読込み -->
    <script src="../js/stork.js"></script>

</body>
</html>
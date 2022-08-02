<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
include("db.php");
$sql = "SELECT * FROM coupon 
    WHERE NOT EXISTS(
         SELECT COUPON_ID FROM my 
         WHERE my.USER_ID=? 
         AND my.COUPON_ID=coupon.COUPON_NO );";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $_SESSION['user']);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
/*print_r($row);<?=$r["START"]?><?=$r["CATEGORY"]?>*/
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/tab.css">
    <title>Document</title>
</head>
<header>
    <div class="wrapper">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="menu">
            <ul>
                <li><a href='logout.php'>ログアウト</a></li>
                <!-- <li>メニュー2</li>
                <li>メニュー3</li>
                <li>メニュー4</li>
                <li>メニュー5</li> -->
            </ul>
        </nav>
    </div>
    <div class="tab_container">
        <input id="tab1" type="radio" name="tab_item" value="view" checked>
        <label class="tab_item" for="tab1">クーポン一覧</label>
        <input id="tab2" type="radio" name="tab_item" value="page">
        <label class="tab_item" for="tab2">あなたのクーポン</label>
</header>

<body>
    <!-- <table border="1">
        <thead>
            <tr>
                <td>名前</td>
                <td>値引価格</td>
                <td>適用店</td>
                <td>開始日</td>
                <td>終了日</td>
                <td>カテゴリ</td>
                <td>説明</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>
        </tbody>
    </table> -->
    <?php foreach ($row as $r) :  ?>
        <a href="save_coupon.php?id=<?= $r["COUPON_NO"] ?>">
            <div class="coupon">
                <div id="title">
                    <h1><?= $r["CNAME"] ?></h1>
                    <p><?= $r["FINISH"] ?>まで</p>
                </div>
                <div id="subtitle">
                    <h2><?= $r["DISCOUNT"] ?>円引き</h2>
                    <p>使用できる店:<?= $r["STORE"] ?></p>
                </div>
                <p id="contents"><?= $r["CONTENTS"] ?></p>
            </div>
        </a>
    <?php endforeach ?>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/tab.js"></script>
</body>

</html>
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
//print_r($row);
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
    <div class="tab_container">
        <input id="tab1" type="radio" name="tab_item" value="view" checked>
        <label class="tab_item" for="tab1">クーポン一覧</label>
        <input id="tab2" type="radio" name="tab_item" value="page">
        <label class="tab_item" for="tab2">あなたのクーポン</label>
</header>

<body>
    <table border="1">
        <thead>
            <tr>
                <td style="background-color: red;">名前</td>
                <td>値引価格</td>
                <td>適用店</td>
                <td>開始日</td>
                <td>終了日</td>
                <td style="background-color: #00ff94;">説明</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($row as $r) :  ?>
                <tr>
                    <td><a href="save_coupon.php?id=<?= $r["COUPON_NO"] ?>"><?= $r["CNAME"] ?></a></td>
                    <td><?= $r["DISCOUNT"] ?></td>
                    <td><?= $r["STORE"] ?></td>
                    <td><?= $r["START"] ?></td>
                    <td><?= $r["FINISH"] ?></td>
                    <td><?= $r["CONTENTS"] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <script src="./js/tab.js"></script>
</body>

</html>
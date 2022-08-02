<?php
/*クーポンのQRコード読み取りと読み取った後のポイント増加処理
session何とかしないと…sessionStorage?
7/27_修正
*/
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
include('db.php');
include('qrCode.php');

use chillerlan\QRCode\QRCode;

$sql = "SELECT COUNT from myblod where id=?";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $_GET['id']);
$stmt->execute();
$data = $stmt->fetch();
// var_dump($data);
$all = $data['COUNT'];

$couponsql = "SELECT MY_NO,COUNT from my where coupon_id=? and user_id=?";
$stmt = $pdo->prepare($couponsql);
$stmt->bindValue(1, $_GET['id']);
$stmt->bindValue(2, $_SESSION['user']);
$stmt->execute();
$data = $stmt->fetch();
// var_dump($data);
$count = $data['COUNT'];
$number = $data['MY_NO'];


//使用するクーポンのコード読み取り(aタブ)
//$qrcode = (new QRCode($options))->render("use_coupon.php?id={$_GET['id']}");
//使用するクーポンのコード読み取り(QR)
/** */
$qrcode = (new QRCode($options))->render("https://click.ecc.ac.jp/ecc/sys1_iesk2bc_a/smartstamp/use_coupon.php?id={$_GET['id']}&user={$_SESSION['user']}");

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/coupon.css">
</head>

<body>
    <header>
        <div id="header">
            <p>Thank you for Using!</p>
        </div>
    </header>
    <main>
        <div id="img">
            <img src="<?= $qrcode ?>" alt="QR_code" id="coupon">
        </div>

        <div id="border">
            <p id="border_txt">♪:*:･･:*:･♪･:*:･･:*:･♪･:*:･･:*:･♪</p>
        </div>

        <a href="use_coupon.php?id=<?= $_GET['id'] ?>&user=<?= $_SESSION['user'] ?>">クーポン減らす</a>
        <script>
            function back() {
                location.replace("myCoupon.php");
            }
        </script>
        <a href="#" onclick="back()">戻る</a>
        <button type="button" id="clear">クリア</button>
        <div id="parent_stamp">
            <div id="stamp">
                <?php for ($i = 0; $i < (int)$all; $i++) : ?>
                    <img src="./images/stampp.png" alt="stamp_image" class="simage">
                <?php endfor ?>
            </div>
        </div>
        <script type="text/javascript">
            var count = '<?= $count ?>';
            var number = '<?= $number ?>';
        </script>
        <script src="./js/uuid.js"></script>
        <script src="./js/coupon.js" type="text/javascript"></script>
    </main>
</body>

</html>
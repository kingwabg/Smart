<?php
// print "hello";
if (!empty($_POST)) {
    // var_dump($_POST);
    include("db.php");

    $id = htmlspecialchars($_POST["name"]);
    $pass = htmlentities($_POST["pass"]);

    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $sercth_sql = "SELECT * FROM user WHERE USER_ID=?";
    $stmt = $pdo->prepare($sercth_sql);
    $stmt->bindValue(1, $_POST["id"]);
    $stmt->execute();
    // fetchColumn!!!!
    $num_rows = $stmt->rowCount();
    //var_dump($num_rows);
    if ($num_rows > 0) {
        header("location: user.php?error=パスワードやIDが登録されてます");
        exit;
    } else if ($stmt == $id) {
        header("location: user.php?error=パスワードが一致してません");
        exit;
    } else {

        //Transaction&commit必要。私のlocalMySQL:auto commit = off だから
        $sql = "INSERT INTO user (USER_ID,PASSWORD) values(?,?);";
        $pdo->beginTransaction();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->bindValue(2, $pass);
        $stmt->execute();
        if ($pdo->commit()) {
            header('Location:login.php');
        }
    }
}
?>
<html>

<head>
    <title>SmartStamp</title>
    <link rel="stylesheet" href="CSS/signin.css">

</head>

<body>
    <form action="" method="POST">
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <div class="main">
            <div class="form">
                <h2>新規登録</h2>
                <p>以下のフォームに入力して登録してください</p>
                <hr>
                <label style="margin-left: -240px;">氏名</label>
                <input type="text" name="name">
                <label style="margin-left: -220px;">電話番号</label>
                <input type="text" name="tel">
                <label style="margin-left: -200px;">パスワード</label>
                <input type="text" name="pass">
                <form method="post" action="">
                    <button type="submit" class="signupbtn">登録</button>
                </form>
                <div><a href="index">戻る</a></div>
            </div>
        </div>
    </form>
</body>

</html>
<?php

/**login */
session_start();
if (!empty($_POST)) {
    //var_dump($_POST);
    include("db.php");

    $id = htmlspecialchars($_POST["name"]);
    $pass = htmlspecialchars($_POST["pass"]);

    $aduser = "SELECT * FROM user_admin WHERE USER_ID=?;";
    $stmt = $pdo->prepare($aduser);
    $stmt->bindValue(1, $id);
    $stmt->execute();
    if ($user = $stmt->fetch()) {
        //var_dump($user);
        $pass = md5($pass);
        if ($pass == $user["PASSWORD"]) {
            print "hello!admin_user!";
            //header();
        } else {
            header('Location:login.php?error=IDまたはパスワードがちがいます');
            exit;
        }
    } else {
        //var_dump($_POST);
        $sql = "SELECT * FROM user WHERE USER_ID=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if ($user = $stmt->fetch()) {
            if (password_verify($pass, $user["PASSWORD"])) {
                //header('Location:user.php');
                /**$_GET残り続ける。移動する先をまだ決めてないから */
                //print "login_OK";
                $_SESSION['user']=$id;
                // header('location:user_main.php');
                header('location:index.php');
                exit();
            } else {
                header('Location:login.php?error=IDまたはパスワードがちがいます');
                exit;
            }
        } else {
            header('Location:login.php?error=IDまたはパスワードがちがいます');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartStamp</title>
    <link rel="stylesheet" href="CSS/log-in.css">
</head>

<body>
    <form action="" method="POST">
        <div class="main">
            <div class="form">
                <?php if (isset($_GET["error"])) {
                    echo ($_GET["error"]);
                }
                ?>
                <div class="form">
                    <h2>LOGIN</h2>
                    <label style="margin-left: -180px;">ユーザーネーム</label>
                    <input type="text" name="name">
                    <label style="margin-left: -200px;">パスワード</label>
                    <input type="text" name="pass">
                    <form method="post" action="">
                        <button type="submit" class="signupbtn">Login</button>
                    </form>
                    <p>新規登録<a href="signin.php">はこちら</a></p>
                    <div><a href="index">戻る</a></div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
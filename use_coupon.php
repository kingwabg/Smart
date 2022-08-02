<?php
// session_start();
/**clickサーバーでは$_GET→$_SESSIONに変更 */
session_start();
include('db.php');
/**admin認証 */
// if(!$_SESSION['admin']){
//     echo <<<EOM
//     <script>
//     alert('適切なユーザーではありません');
//     window.close();
//     </script>
//     EOM;
//     exit();
// }




if(isset($_GET)){
    //echo (gettype($_SESSION['user']));
    $sql="SELECT*FROM my where COUPON_ID=? and USER_ID=?;";
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(1,$_GET['id']);
    $stmt->bindValue(2,$_GET['user']);
    $stmt->execute();
    if($data=$stmt->fetch()){
        // print_r($data);
        //UPDATEに変更
        if(intval($data['COUNT'])<=0){
            $flag_sql="UPDATE  my set flag=1 where my.COUPON_ID=? and my.USER_ID=?;";
            $pdo->beginTransaction();
            $stmt=$pdo->prepare($flag_sql);
            $stmt->bindValue(1,(int)$_GET['id'],PDO::PARAM_INT);
            $stmt->bindValue(2,$_GET['user']);
            $stmt->execute();
            if($pdo->commit()){
                header('location:myCoupon.php');
                exit();
            }
        }
        $delete_sql="UPDATE my  SET COUNT=COUNT-1 WHERE my.USER_ID=? AND my.COUPON_ID=?;";
        $pdo->beginTransaction();
        $status=$pdo->prepare($delete_sql);
        $status->bindValue(1,$_GET['user']);
        $status->bindValue(2,(int)$_GET['id'],PDO::PARAM_INT);
        $status->execute();
        if($pdo->commit()){
            //print'OK' ;
            // header("location:show_coupon.php?id={$_GET['id']}&user={$_GET['user']}");
            // exit();
            //ajax
            //$_SESSION['user']=$_GET['user'];
            $id=$_GET['id'];
        }
    }
    //●使い終わったやつどう管理する？→全部使い終わったらmyにフラグ立てる_OK
    //●スマホから読み取った時に使用回数減らす_OK
    /*  ⇑※セッションデータ(ユーザID)がない為エラー出る*/
    //●使い終わったやつ見せないように_OK
    //●不正規アクセス防止(ログインしないと入れない)_OK
    //●ページ遷移で履歴調整_OK   

    //クーポンは期限過ぎたら消去(myデータベースのデータと共に)
    //スマホとの連携→ログインからQRで
    //アナログ(紙):クーポン保存をQR、デジタル(web、スマホ):ボタン…とか
    /**
     * クーポン使うってどうやって？
     * アドミンユーザーどうする
     * ぺーじととのえる
    */
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/read.css">
    <title>Document</title>
</head>
<body>
    <!-- クリックしてモーダルを表示させるボタン -->
    <!-- <a href="#" class="btn">モーダルウィンドウを表示</a> -->

    <!-- オーバーレイ(黒い背景) -->
    <div class="overlay"></div>

    <!-- モーダルウィンドウ -->
    <div class="modal">
    <!-- モーダルウィンドウを閉じる×ボタン -->
    <div class="close">×</div>
        <h2>読み取りが完了しました。</h2>
        <p>ページが閉じない場合は、前のページに移動してください</p>
    </div>

    <!-- 高さを出すためのsectionタグ -->
    <section></section>
    <script type="text/javascript">
        var id='<?= $id?>';
    </script>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/read.js" type="text/javascript"></script>
</body>
</html>
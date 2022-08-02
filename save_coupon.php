<?php
/*7/27_修正*/
    session_start();
    include('db.php');
    
    $serch_sql="SELECT count FROM myblod where  id=?;";
    $cou_save_sql="INSERT into my(USER_ID,COUPON_ID,COUNT) values(?,?,?);";
    //print($_GET["id"]);
    $stmt=$pdo->prepare($serch_sql);
    $stmt->bindValue(1,$_GET["id"]);
    $stmt->execute();
    $count=$stmt->fetch();
    // print_r ($count);


    $pdo->beginTransaction();
    $stmt=$pdo->prepare($cou_save_sql);
    $stmt->bindValue(1,$_SESSION['user']);
    $stmt->bindValue(2,$_GET["id"]);
    $stmt->bindValue(3,(int)$count['count'],PDO::PARAM_INT);
    if($stmt->execute()){
        $pdo->commit();
        header('location:myCoupon.php');
    }
?>
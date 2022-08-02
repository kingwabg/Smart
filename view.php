<?php
include("db.php");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = isset($_GET['id'])? $_GET['id'] : "";
$stmt = $pdo->prepare("SELECT * FROM coupon where id=? ");
$stmt->bindParam(1, $id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$row = $stmt->fetch();
header('Content-Type:'.$row['mime']);
echo $row['data'];
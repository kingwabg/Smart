<?php 


$dbHost = "localhost";
$dbName = "sys1_iesk2bc_a";
$dbUser = "sys1_iesk2bc_a";
$dbpassword = "kH3FEUKw";
// $dbHost = "localhost";
// $dbName = "stamp";
// $dbUser = "testuser";
// $dbpassword = "abc";

// $dbHost = "localhost:8889";
// $dbUser = "root";
// $dbpassword = "root";
// $dbName = "sys1_iesk2bc_a";

try {
    //code...
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbpassword);
    // 연결확인을 위한 확인 메세지
    // echo "Connectin Successful";
    // // $sql = 'SELET * FROM contactme.items';
    // $users = $dbh->query('select * from contactme.items');
    
} catch (PDOException $e) {
    // 연결확인을 위한 확인 메세지
    echo "DB Connectin Failed: " . $e->getMessage();
}
?>
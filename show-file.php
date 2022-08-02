<?php

/*** assign the image id ***/
$image_id = 4;
try {
    /*** connect to the database ***/
    include("db.php");

    /*** set the PDO error mode to exception ***/
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*** The sql statement ***/
    $sql = "SELECT image, image_type FROM testblob WHERE image_id=$image_id";

    $sql1 = "SELECT * FROM testblob";

    /*** prepare the sql ***/
    $stmt = $pdo->prepare($sql1);

    /*** exceute the query ***/
    $stmt->execute();

    /*** set the fetch mode to associative array ***/
    $stmt->setFetchMode(PDO::FETCH_ASSOC);


    while ($row = $stmt->fetch()) {
        # code...
        echo "<li>" . $row['image_name'] . "</li>";

        header('Content-type:' . $row['image_type']);
        echo $row['image'];

        // echo "<li><a target = '_blank' herf ='view.php?id=".$row['image_name']."'></a></a>""  </li>"
    }

    //     /*** set the header for the image ***/
    //     $array = $stmt->fetch();
    //     // print_r($array);
    //     $contents_type = array(
    //         'png'  => 'image/png',
    //         'jpg'  => 'image/jpeg',
    //         'jpeg' => 'image/jpeg',
    //         'gif'  => 'image/gif',
    //         'bmp'  => 'image/bmp',
    //     );


    //     // sizeof 함수는 배열의 크기를 나타내는 함수로 count 함수의 별칭입니다. 
    //     // 여기서 배열의 크기란 배열에 포함된 모든 요소의 개수를 의미합니다.

    //         /*** set the headers and display the image ***/
    //         // 헤더를 설정하고 이미지를 표시합니다.
    //         header('Content-type: ' . $contents_type[$img['type']]);
    //         echo $img['image'];

} catch (PDOException $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}

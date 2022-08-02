
<?php
include("db.php");
$board_number = 1;
// $_FILES['upload']['name']는 첫번째 인자 upload는 <input type="file" name="upload"/>을 의미합니다.
$uploads_dir = "uploads/$board_number";
$name = $_FILES['upload']['name'];
$uploadfile = $_FILES['upload']['name'];

// is_dir():フォルダの存在有無を確認する関数
if (!is_dir($uploads_dir)) {
  mkdir($uploads_dir);
  if (move_uploaded_file($_FILES['upload']['name'], "$uploads_dir/$name")) {
    $sal = "INSERT INTO topic2(title) VALUSE('$name')";
    $result = mysqli_query($conn, $sal);
    echo "dbbb.<br />";
    echo "<img src= './uploads/1/$name'><br/>";
    echo "1. file name : {$_FILES['upload']['name']}<br/>";
    echo "2. file type : {$_FILES['upload']['type']}<br/>";
    echo "3. file size : {$_FILES['upload']['size']}byte<br/>";
    echo "4. temporary file name : {$_FILES['upload']['size']}byte<br/>";
  } else {
    if (move_uploaded_file($_FILES['upload']['name'], "$uploads_dir/$name")) {
      $sal = "INSERT INTO topic2(title) VALUSE('$name')";
      $result = mysqli_query($conn, $sal);
      echo "dbbb.<br />";
      echo "<img src= './uploads/1/$name'><br/>";
      echo "1. file name : {$_FILES['upload']['name']}<br/>";
      echo "2. file type : {$_FILES['upload']['type']}<br/>";
      echo "3. file size : {$_FILES['upload']['size']}byte<br/>";
      echo "4. temporary file name : {$_FILES['upload']['size']}byte<br/>";
    } else {
      echo "xxxx";
    }
  }
}


// 이미지 표시 코드

// while($row = mysql_fetch_row($result)) {
//     echo "<tr>";
//     echo "<td><img src='uploads/$row[6].jpg' height='150px' width='300px'></td>";
//     echo "</tr>\n";
// }
?>
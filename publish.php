<?php
include("db.php");
if (isset($_POST['btn'])) {
  $name = $_FILES['myfile']['name'];
  $type = $_FILES['myfile']['type'];
  $data = file_get_contents($_FILES['myfile']['tmp_name']);
  $stmt = $pdo->prepare("INSERT INTO myblod VALUES('',?,?,?,?,?,?,?,?,?,?)");
  $stmt->bindParam(1, $name);
  $stmt->bindParam(2, $type);
  $stmt->bindParam(3, $data);
  $stmt->bindValue(4, $_POST["cname"]);
  $stmt->bindValue(5, $_POST["store"]);
  $stmt->bindValue(6, $_POST["start"]);
  $stmt->bindValue(7, $_POST["finish"]);
  $stmt->bindValue(8, $_POST["contents"]);
  $stmt->bindValue(9, $_POST["count"], PDO::PARAM_INT);
  $stmt->bindValue(10, $_POST["discount"], PDO::PARAM_INT);

  $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- 가장 많이 사용되는 방법으로 뒤에 Chrome=1을 추가해줍니다. 이 경우 Chromeframe을 사용하는 유저에게 렌더링합니다. -->
  <meta http-equiv="X-UA-Compatible" content="IE=Edge; chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<h1> クーポン発行</h1>

<body>
  <label for="image">スタンプ画像</label>


  <form enctype="multipart/form-data" method="post">
    <input name="myfile" type="file" />
  <!-- </br><button name="btn">Upload</button>
  </form>
  <form action="delete.php" method="POST">
    <button name="dbtn">delete</button>
  </form> -->

  <form action="publish.php" method="POST">
    <label>クーポンの名前</label></br>
    <input type="text" name="cname"></br>
    <label>説明</label></br>
    <textarea name="contents" type="text" style="width:300px;height:200px;font-size:12px; ">説明を入力してくだい。</textarea>
    <br></br>
    <label>回数</label> 
    <input type="number" name="count" value="10"></br>
    <p>日時指定</p>
    <input type='date' id='currentDate' name="start" />
    <script>
      document.getElementById('currentDate').value = new Date().toISOString().substring(0, 10);;
    </script>
    <input type='date' id='currentDate1' name="finish" />
    <script>
      document.getElementById('currentDate1').value = new Date().toISOString().substring(0, 10);;
    </script>
    <br></br>

    <label>%</label>
    <input type="d" name="discount" value="10"></br>
    
    <label>店</label>
    <input type="text" name="store">
    <br></br>
    <div class="bt_se">
      <button name= "btn" type="submit">クーポン発行</button>
    </div>

  </form>


</body>

</html>
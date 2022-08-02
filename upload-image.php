<!DOCTYPE html>

<html>

<head>
    <title>File Upload To Database</title>
</head>

<body>
    <h2>Please Choose a File and click Submit</h2>

    <?php
    include("db.php");

    if (isset($_POST['btn'])) {
        $name = $_FILES['myfile']['name'];
        $type = $_FILES['myfile']['type'];
        $data = file_get_contents($_FILES['myfile']['tmp_name']);
        $stmt = $pdo->prepare("INSERT INTO myblod VALUES('',?,?,?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $type);
        $stmt->bindParam(3, $data);
        $stmt->execute();
    }
    ?>
    <form enctype="multipart/form-data" method="post">
        <input name="myfile" type="file" />
        <button name="btn">Upload</button> 
    </form>
    



    <?php
    $stat = $pdo->prepare("SELECT * FROM myblod");
    $stat->execute();
    while ($row = $stat->fetch()) {
        # code...
        // echo "<li>" . $row['name'] . "</li>";
        echo "<li><a target = '_blank' href ='view.php?id=" . $row['id'] . "'>" . $row['name'] . "</a><br/>
        <embed src='data:".$row['mime'].";base64,".base64_encode($row['data'])."'width='200'/></li>";
    }
    ?>
</body>

</html>
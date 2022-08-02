<?php
include("db.php");
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>

<body>
    <input type="button" value="クーポン発行" onclick="showPopup();" />
    <script language="javascript">
        function showPopup() {
            window.open("check.html", "a", "width=500, height=700, left=300, top=50");
        }
    </script>
</body>
</head>

<body>

    <p style="font-size:25px; text-align:center"><b>クーポン一覧</b></p>
    <table align=center>
        <thead align="center">
            <tr>
                <td>番号</td>
                <td>番号</td>
                <td>コード</td>
                <td>クーポン名</td>
                <td>発行店名</td>
                <td>有効期限</td>
                <td>状態</td>
            </tr>
        </thead>

        <tbody>
            <?php
            // SQL文
            $sql = "SELECT * FROM boder ORDER BY id DESC";
            $stmt = $pdo->query($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
            foreach ($row as $r) {
            ?>
                <tr class="even">
                <tr>
                    <td>
                        <?php
                        $stat = $pdo->prepare("SELECT * FROM myblod");
                        $stat->execute();
                        while ($row = $stat->fetch()) {
                            echo "<embed src='data:" . $row['mime'] . ";base64," . base64_encode($row['data']) . "'width=100 height=100' /></li>";
                            break;
                        }
                        ?>
                    </td>
                    <td><?php echo $r['number'] ?></td>
                    <td><?php echo $r['title'] ?></td>
                    <td><?php echo $r['id'] ?></td>
                    <td><?php echo $r['date datetime'] ?></td>
                    <td><?php echo $r['hit'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class=text>
        <a href="http://"></a>
        <button onClick="location.href='./write.php'">修正</button>
        <button onClick="location.href='./write.php'">削除</button>
    </div>
</body>

</html>
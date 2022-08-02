<?php
include "db.php";


$stat = $pdo->prepare("SELECT * FROM myblod");
$stat->execute();
$row1 = $stat->fetch();
if (isset($_POST['dbtn'])) {
  $d = $row1['id'];
  $stat = $pdo->prepare("DELETE FROM myblod where id = $d ");
  $stat->execute();
}

?>
<script type="text/javascript">
  alert("삭제되었습니다.");
</script>
<meta http-equiv="refresh" content="0 url=publish.php" />
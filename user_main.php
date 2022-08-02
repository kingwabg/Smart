<?php
// $sql="SELECT*FROM coupon
// join my on my.coupon_id=coupon.coupon_no
// where my.user_id=?
// and my.flag!=1;";

/**7/27修正 */
session_start();
if (!isset($_SESSION['user'])) {
  header('location:login.php');
  exit();
}
include("db.php");
$sql = "SELECT * FROM myblod 
    WHERE NOT EXISTS(
    SELECT COUPON_ID FROM my 
    WHERE my.USER_ID=? 
    AND my.COUPON_ID=myblod.id );";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $_SESSION['user']);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($row);

$sql1 = "SELECT COUNT(*) FROM myblod
join my on my.coupon_id=myblod.id
where my.user_id=?
and my.flag!=1;";
$stmt1 = $pdo->prepare($sql1);
$stmt1->bindValue(1, $_SESSION['user']);
$stmt1->execute();
$row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
// print_r($row1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="1.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>


</head>


<body>

  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a href="index.php" class="point logo" aria-current="page"><img src="images/point.png" alt="" width="120" height="120"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">お知らせ</a>

            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">お店を探す</a>

            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">お得な情報</a>

            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">キャンペーン</a>

            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">よくある問い合わせ</a>
          </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">ようこそ、 <?php echo $_SESSION["user"], " さん"; ?></a>

              <?php foreach ($row1 as $r) : ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  GET <?= $r["COUNT(*)"] ?>+
                  <span class="visually-hidden">unread messages</span>
                </span>
              <?php endforeach ?>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="myCoupon.php">新規登録</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                <li><a class="dropdown-item" href="myCoupon.php">保有クーポン</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">登録状況</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php">ログアウト</a></li>
              </ul>
            </li>
          </ul>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">
                    <p>クーポンタイプをチェックしてください。 </p>
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <script language="javascript">
                    function check() {
                      var form = document.form1;
                      //첫번째 라디오 버튼을 선택한 경우
                      if (form.ex[0].checked == true) {
                        //현재 폼의 action 값을 menu_1.html이라는 파일로 만든다
                        form.action = "publish.php";
                      }
                      //두번째 라디오 버튼을 선택한 경우
                      else if (form.ex[1].checked == true) {
                        form.action = "publish.php";
                        // form.action = "menu_2.html";
                      } else {
                        form.action = "menu_3.html";
                      }
                      form.submit();
                    }
                  </script>

                  <link rel="stylesheet" href="CSS/super-awesome.css">
                  <div class="cc-selector">
                    <form name="form1" method="post">
                      <input id="visa" type="radio" name="ex" value="visa" />
                      <label class="drinkcard-cc visa" for="visa"></label>
                      <input id="mastercard" type="radio" name="ex" value="mastercard" />
                      <label class="drinkcard-cc mastercard" for="mastercard"></label>
                      <div class="modal-footer">
                        &nbsp;&nbsp; <a href="javascript:check()" role="button">確認</a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

  </header>
  <nav class="nav" aria-label="Secondary navigation " style="margin: 10px;">
    <div>
      <!-- Button trigger modal -->
      <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: blue; color: honeydew;">クーポン作成 </button>
    </div>
    <a class="nav-link active" aria-current="page" href="#">すべて</a>
    <a class="nav-link" href="#">割引クーポン</a>
    <a class="nav-link" href="#">スタンプクーポン</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="何をお探しですか？" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </nav>

  <main style="margin: 5px; width: 80%; height: 1000px;">
    <!--消えるのもOK-->
    <?php $row = array_reverse($row); ?>
    <?php foreach ($row as $r) : ?>
      <div class="row-md-4">
        <div class="card" style="width: 18rem; height: 18rem; padding: 10px;">
          <!--style="width: 18rem;-->
          <?php echo "<embed src='data:" . $r['mime'] . ";base64," . base64_encode($r['data']) . "'width=100 height=100' class='card-img-top' />" ?>
          <div class="card-body">
            <h5 class="card-title text-2xl font-bold" style="overflow : hidden; text-overflow : ellipsis; height : 25px; word-wrap : brek-word; display : -webkit-box; -webkit-line-clamp : 1; -webkit-box-orient: vertical;"><?= $r['cname'] ?></h5>
            <p class="card-text" style="overflow : hidden; text-overflow : ellipsis; height : 50px; word-wrap : brek-word; display : -webkit-box; -webkit-line-clamp : 2; -webkit-box-orient: vertical;"><?= $r['contents'] ?></p>
          </div>
          <!-- <div style="padding: 10px;"> -->
          <a href="save_coupon.php?id=<?= $r["id"] ?>" class="btn btn-primary w-14 h-11 
          m-1">GET</a>
          </ div>
        </div>
      </div>
    <?php endforeach ?>

  </main>
  <aside style="float:right;">
    <nav>
      <img src="images/7eleven.jpg">
      <img src="images/7eleven.jpg">
      <img src="images/7eleven.jpg">
      <img src="images/7eleven.jpg">
      <img src="images/7eleven.jpg">

    </nav>
  </aside>

  <!-- 없어없어 ! ! 여기서 작업 하는거야 섹 -->

</body>

<!-- <footer>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav>
</footer> -->

</html>
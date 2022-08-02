
<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('location:login.php');
        exit();
    }
    include("db.php");
    
    
    $sql="SELECT*FROM coupon
    join my on my.coupon_id=coupon.coupon_no
    where my.user_id=?
    and my.flag!=1;";
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(1,$_SESSION['user']);
    $stmt->execute();
    $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //print_r($row);
?>

<!doctype html>
<html lang="en">

<head>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="1.css" rel="stylesheet">

  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a href="#" class="point logo"><img src="images/point.png" alt="" width="120" height="120"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 50px;">
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">マイホーム</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">保有クーポン</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">登録状況</a></li>
            </ul>
          </li>

        </ul>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >クーポン作成 </button>

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

        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

</head>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

<body>
  <main>

    <nav class="nav" aria-label="Secondary navigation">
      <a class="nav-link active" aria-current="page" href="#">すべて</a>
      <a class="nav-link" href="#">割引クーポン</a>
      <a class="nav-link" href="#">スタンプクーポン</a>
    </nav>
<!-- 
    <?php foreach($row as $r):  ?>
                <tr>
                    <td><a href="show_coupon.php?id=<?=$r["COUPON_NO"]?>"><?=$r["CNAME"]?></a></td>
                    <td><?=$r["DISCOUNT"]?></td>
                    <td><?=$r["STORE"]?></td>
                    <td><?=$r["START"]?></td>
                    <td><?=$r["FINISH"]?></td>
                    <td><?=$r["CONTENTS"]?></td>
                </tr>
            <?php endforeach?> -->

    <div>
      <div class="con">
        <div class="row-md-4">
          <div class="card" style="width: 18rem;">
            <img src="images/coupon2.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
              <a href="#" class="btn btn-primary">GET</a>
            </div>
          </div>
        </div>
        <div class="row-md-4">
          <div class="card" style="width: 18rem">
            <img src="images/coupon2.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
              <a href="#" class="btn btn-primary">GET</a>
            </div>
          </div>
        </div>
        <div class="row-md-4">
          <div class="card" style="width: 18rem;">
            <img src="images/coupon2.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
              <a href="#" class="btn btn-primary">GET</a>
            </div>
          </div>
        </div>
        <div class="row-md-4">
          <div class="card" style="width: 18rem;">
            <img src="images/coupon2.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
              <a href="#" class="btn btn-primary">GET</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row-md-4">
        <div class="card" style="width: 18rem;">
          <img src="images/coupon2.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
            <a href="#" class="btn btn-primary">GET</a>
          </div>
        </div>
      </div>
      <div class="row-md-4">
        <div class="card" style="width: 18rem;">
          <img src="images/coupon2.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
            <a href="#" class="btn btn-primary">GET</a>
          </div>
        </div>
      </div>
      <div class="row-md-4">
        <div class="card" style="width: 18rem;">
          <img src="images/coupon2.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
            <a href="#" class="btn btn-primary">GET</a>
          </div>
        </div>
      </div>
      <div class="row-md-4">
        <div class="card" style="width: 18rem;">
          <img src="images/coupon2.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
            <a href="#" class="btn btn-primary">GET</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <aside>
    <nav>
      <img src="images/7eleven.jpg" style="max-width: 100%; height: auto;">
      <img src="images/7eleven.jpg" style="max-width: 100%; height: auto;">
      <img src="images/7eleven.jpg" style="max-width: 100%; height: auto;">
      <img src="images/7eleven.jpg" style="max-width: 100%; height: auto;">

    </nav>
  </aside>


  <footer>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>
  </footer>
</body>

</html>
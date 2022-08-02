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
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- link -->
  <link href="/smartstamp/CSS/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <a href="#" class="point logo" aria-current="page"><img src="images/point.png" alt="" width="120" height="120"></a>
</head>

<body class="bg-gray-50">
  <div class="wrapper box-border">
    <main>
      <div class="container ">
        <div class="product-wrap px-5 shadow-md">
          <main>
            <div class="container ">
              <div class="flex items-center w-auto w-96 mb-10  ">
                <div class="mb-5">
                  <div class="flex flex-col ">
                    <label for="product_no" class="text-gray-500 text-left uppercase tracking-wider">クーポン名</label>
                    <input type="text" name="cname" id="product_no" class="px-2 py-2 border rounded-md outline-none focus:border-green-200" value="">
                    <label for="product_no" class="text-gray-500 text-left uppercase tracking-wider">店</label>
                    <input type="text" name="store" id="product_no" class="px-2 py-2 border rounded-md outline-none focus:border-green-200" value="">
                  </div>
                </div>


                <div class="flex flex-col flex-grow items-center">
                  <svg class="w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-width="0.8" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                  </svg>
                  <input type="file" name="myfile" id="upload_image" class="hidden">
                  <label for="upload_image" class="text-indigo-600 py-4">
                    <span class="border rounded-md border-indigo-600 p-2 mx-auto hover:bg-indigo-600 hover:text-white">ファイルを添付</span>
                  </label>
                  <p class="text-sm text-center">PNG, JPG, GIF<br>2MB以内</p>
                </div>
                <div style="width: 30%;">
                  <figure class="thumb h-full">
                    <img class="object-contain " alt="プレビュー" style=" width: 50%;">
                  </figure>
                  <!-- div[class=asdd]*2 -->
                </div>
                </form>
                <script src="/smartstamp/kadai05.js"></script>
              </div>
              <!--/.container-->
          </main>


          <form action="" method="POST">
            <div class="flex mb-10">
              <div class="flex-grow mr-10">
                <div class="mb-5">
                  <div class="flex flex-col flex-grow ">
                    <label type="number" class="text-gray-500 text-left uppercase tracking-wider">回数</label>
                    <select name="count" id="count" class="px-2 py-2 border  rounded-md outline-none focus:border-green-200">
                      <option value="10">10</option>
                      <option value="9">9</option>
                    </select>
                  </div>
                </div>

                <div class="flex justify-between mb-5">
                  <div class="flex flex-col w-5/12">
                    <label for="product_no" class="text-gray-500 text-left uppercase tracking-wider">試用期間</label>
                    <input type='date' id='currentDate' name="start" class="px-2 py-2 border rounded-md outline-none focus:border-green-200" value="">
                    <script>
                      document.getElementById('currentDate').value = new Date().toISOString().substring(0, 10);;
                    </script>
                  </div>

                  <div class="flex flex-col w-5/12">
                    <label for="price" class="text-gray-500 text-left uppercase tracking-wider">終了</label>
                    <input type='date' id='currentDate1' name="finish" type class="px-2 py-2 border rounded-md outline-none focus:border-green-200" value="" ?>
                    <script>
                      document.getElementById('currentDate1').value = new Date().toISOString().substring(0, 10);;
                    </script>
                  </div>
                </div>

                <div class="flex flex-col">
                  <label for="name" class="text-gray-500 text-left uppercase tracking-wider">割引</label>
                  <input type="number" name="discount" id="discount" class="px-2 py-2 border rounded-md outline-none focus:border-green-200" value="">
                </div>
              </div>

              <div class="flex flex-col items-stretch flex-grow shadow-md ...">
                <label for="description" class="text-gray-500 text-left uppercase tracking-wider">説明</label>
                <textarea name="contents" id="description" class="w-full h-full text-lg px-2 bg-gray-100 py-2 border rounded-md" placeholder="説明を入力してくだい。"></textarea>
              </div>
            </div>

            <div class="flex justify-end">
              <a href="" class="text-white text-center leading-10 bg-gray-600 px-10 mr-5 hover:bg-gray-500 rounded-md">一覧へ戻る</a>
              <button name="btn type=" submit" class="text-white text-center leading-10 bg-pink-600 px-10 hover:bg-pink-500 rounded-md">登録する</button>
            </div>
          </form>

        </div>
        <!--/.product-wrap-->

      </div>
      <!--/.container-->
    </main>

  </div>
  <!--/.wrapper-->
</body>

</html>
{
    $(document).ready(function(){ 
        // ボタンをクリックしたら
          // モーダルウィンドウとオーバーレイをフェードインさせる
          $(".modal").fadeIn();
          $(".overlay").fadeIn();
      
          console.log("hello"+id)
        // モーダルウィンドウ内の×ボタンかオーバーレイをクリックしたら
        $(".close, .overlay").click(function () {
            // モーダルウィンドウとオーバーレイをフェードアウトさせる
            $(".modal").fadeOut();
            $(".overlay").fadeOut();
            //スマホから読み取る時は動く 強制終了ひつようかも
            window.close();
            //それ以外はshowに遷移(flagつき)
            location.href='show_coupon.php?id='+id;
         });
      });
}
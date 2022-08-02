<?php
// 쿠폰번호 생성함수
function coupon_generator($len)
{
    $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';

    srand((float)microtime() * 1000000);

    $i = 0;
    $str = "";

    while ($i < $len) {
        echo ($len);
        $num = rand() % strlen($chars);
        $tmp = substr($chars, $num, 1);
        $str .= $tmp;
        $i++;
    }
    // 문자 치환
    $str = preg_replace('/([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})([0-9A-Z]{4})/', '\1-\2-\3-\4', $str);
    echo ($str);
    return $str;
}


echo coupon_generator(8);




?>
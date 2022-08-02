<?php
  
declare(strict_types=1);
  
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
  
require_once('vendor/autoload.php');
  
$options = new QROptions(
  [
    'eccLevel' => QRCode::ECC_L,
    'outputType' => QRCode::OUTPUT_MARKUP_SVG,
    'version' => 5,
  ]
);
//QRの中身
// $qrcode = (new QRCode($options))->render('http://(IPアドレス):80/');
?>
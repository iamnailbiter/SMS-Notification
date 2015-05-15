<?php

require_once 'Class/Gammu.php';

$gammu = new Gammu();

$message = "Terimakasih telah melakukan pembayaran. Pembayaran sudah kami terima";
$receiver = "088801960320";

$send = $gammu->inject($message,$receiver,$response);
print_r($response);
if($send==1){
    echo "SMS Terkirim\n";
}else{
    echo "SMS Gagal\n";
}

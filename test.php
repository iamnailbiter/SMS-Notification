<?php

require_once 'Class/Gammu.php';

$gammu = new Gammu();

$message = "Terimakasih telah melakukan pembayaran. Pembayaran sudah kami terima";
$receiver = "085641867014";

$send = $gammu->inject($message,$receiver,$output);
print_r($output);
if($send==1){
    echo "SMS Terkirim";
}else{
    echo "SMS Gagal";
}
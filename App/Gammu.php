#!/usr/bin/php -q
<?php

$app_path = "/home/nailbiter/Github/SMS-Notification";
require_once $app_path.'/Class/Gammu.php';
require_once $app_path.'/Class/Database.php';
require_once $app_path.'/Class/TableGateway.php';
require_once $app_path.'/Class/GammuTable.php';
require_once $app_path.'/Class/KonfirmasiTable.php';
require_once $app_path.'/Class/InvoiceTable.php';

$gammu = new Gammu();

print_r($gammu->syncKonfirmasi());

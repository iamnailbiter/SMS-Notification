<?php

require_once 'Class/Gammu.php';

$gammu = new Gammu();

$message = "Test Daemon PHP";
$receiver = "088801960320";

$do = $gammu->gammu_inject($message,$receiver);

printf($do);
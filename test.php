<?php

require_once 'Class/Gammu.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$gammu_bin 		= '/usr/bin/gammu';
$gammu_config 		= '/etc/gammu-smsdrc';
$gammu_config_section	= ''; // for default section please set "blank" value --> $gammu_config_section = '';

$sms = new Gammu($gammu_bin,$gammu_config,$gammu_config_section);

$response = $sms->phoneBook('ME');
    //echo '<pre>';
    print_r($response);
    //echo '</pre>';
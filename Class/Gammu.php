<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gammu
 *
 * @author nailbiter
 */
class Gammu {
    
    /* Initializing gammu bin/EXE */
    var $gammu_inject = "/usr/bin/gammu-smsd-inject";
    
    var $datetime_format = 'Y-m-d H:i:s';
    
    function inject($message,$receiver,&$response) {
        $smsd_inject = $this->gammu_inject.' TEXT '.$receiver.' -text "'.$message.'"';
        exec($smsd_inject, $output);
        for($i=0;$i<count($output);$i++) {
                $response.=$output[$i]."\r\n";
            }
	//return $response;
        if(eregi("Written message with ID",$response)){
            return 1;
        }else{
            return 0;
        }
    }
}

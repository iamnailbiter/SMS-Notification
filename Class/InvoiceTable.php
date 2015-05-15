<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceTable
 *
 * @author nailbiter
 */
    class InvoiceTable {
        //put your code here
        public function __construct() {
            
        }
        
        public function setInvoiceStatus($id,$state)
        {
            $con = new Database();
            $db = $con->connect();
            $sth = $db->prepare("UPDATE invoice SET status=$state WHERE kd_invoice='$id'");
            $sth->execute();
        }

    }

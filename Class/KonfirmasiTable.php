<?php

    class KonfirmasiTable extends TableGateway{
        //put your code here
        public function __construct()
        {

        }
    
        public function insertKonfirmasi($data)
        {
            $con = new Database();
            $db = $con->connect();
            $sth = $db->prepare("INSERT INTO konfirmasi (sender, kd_client,kd_invoice,tgl_bayar,jml_bayar,bank_to,bank_from,nama_rek,no_rek) VALUES (:sender, :kd_client,:kd_invoice,:tgl_bayar,:jml_bayar,:bank_to,:bank_from,:nama_rek,:no_rek)");
            //$sth->bindParam(':id',$data['id'],PDO::PARAM_INT);
            $sth->bindParam(':kd_client',$data[1],PDO::PARAM_STR);
            $sth->bindParam(':kd_invoice',$data[2],PDO::PARAM_STR);
            $sth->bindParam(':tgl_bayar',$data[3],PDO::PARAM_STR);
            $sth->bindParam(':jml_bayar',$data[4],PDO::PARAM_INT);
            $sth->bindParam(':bank_to',$data[5],PDO::PARAM_STR);
            $sth->bindParam(':bank_from',$data[6],PDO::PARAM_STR);
            $sth->bindParam(':nama_rek',$data[7],PDO::PARAM_STR);
            $sth->bindParam(':no_rek',$data[8],PDO::PARAM_STR);
            $sth->bindParam(':sender',$data[9],PDO::PARAM_STR);
            $sth->execute();
        }
        
    }

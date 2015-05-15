<?php

    class Gammu {

        /* Initializing gammu bin/EXE */
        var $gammu_inject = "/usr/bin/gammu-smsd-inject";

        var $datetime_format = 'Y-m-d H:i:s';

        public function inject($message,$receiver,&$response)
        {
            $smsd_inject = $this->gammu_inject.' TEXT '.$receiver.' -text "'.$message.'"';

            exec($smsd_inject, $r);

            for($i=0;$i<count($r);$i++)
            {
                $response.=$r[$i]."\r\n";
            }

            if(eregi("Written message with ID",$response))
            {
                return 1;
            }else{
                return 0;
            }
        }

        public function syncKonfirmasi()
        {
            //Untuk sinkronisasi Konfirmasi Pembayaran dari Client ke Database Pembayaran
            $gammuTable = new GammuTable();
            $konfirmasiTable = new KonfirmasiTable();
            $invoiceTable = new InvoiceTable();
            $data =  $gammuTable->getAllNewKonfirmasi();
            foreach ($data as $val) {
                $sms = $val['TextDecoded'];
                $data_sms = explode("#", $sms);
                $data_sms[9]=$val['SenderNumber'];
                $konfirmasiTable->insertKonfirmasi($data_sms);
                $gammuTable->setReadInbox($val['ID']);
                $invoiceTable->setInvoiceStatus($data_sms[2], 1);
            }
        }

        
        public function sendThanksPembayaran($invoice_id,$receiver)
        {
            $message = "Terimakasih, pembayaran anda atas invoice #".$invoice_id." telah kami terima";
            $sms = $this->inject($message, $receiver, $response);
            if($sms==1)
            {
                //Update database, informasikan bahwa client telah dikonfirmasi pembayarannya
            }else{
                //Show Notification, pengiriman sms gagal
            }
        }

        public function sendInvoice($invoice_id,$receiver)
        {
            $message = "Invoice #".$invoice_id." telah kami kirimkan, silahkan cek email anda dan lakukan pembayaran.";
            $sms = $this->inject($message, $receiver, $response);
            if($sms==1)
            {
                //Update database, informasikan bahwa client telah dikonfirmasi pembayarannya
            }else{
                //Show Notification, pengiriman sms gagal
            }
        }
    }

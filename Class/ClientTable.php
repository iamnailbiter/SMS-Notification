<?php    
    class ClientTable extends TableGateway
    {
        
        public function __construct()
        {

        }
                
        public function findClient($data)
        {
            $kd_client = $data['kd_client'];
            $con = new Database();
            $db = $con->connect();
            $res = $db->query("SELECT * FROM client where kd_client='$kd_client'");
            
            $record = $res->fetch(PDO::FETCH_ASSOC);
            return $record;
        }

    }   
?>
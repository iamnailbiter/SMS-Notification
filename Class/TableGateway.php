<?php
    class TableGateway
    {
        
        public function __construct()
        {

        }
        
        public function getAllData($table)
        {
            $con = new Database();
            $db = $con->connect();
            $data = $db->query("SELECT * FROM $table");
            
            if($data === false){
		return NULL;
            }

            $record = $data->fetchall(PDO::FETCH_ASSOC);
            return $record;
        }
        
        public function getData($table,$param,$value)
        {
            $con = new Database();
            $db = $con->connect();
            $data = $db->query("SELECT * FROM $table WHERE $param='$value'");
            
            if($data === false){
		return NULL;
            }

            $record = $data->fetch(PDO::FETCH_ASSOC);
            return $record;
        }
        
    }
?>
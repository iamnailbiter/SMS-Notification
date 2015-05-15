<?php

class GammuTable extends TableGateway{
    //put your code here
    public function __construct()
    {

    }

    public function getAllNewKonfirmasi()
    {
        $con = new Database();
        $db = $con->connect();
        $res = $db->query("SELECT * FROM inbox WHERE SUBSTRING_INDEX(TextDecoded, '#', 1) = 'PAY' AND Processed='false'");
        $record = $res->fetchAll(PDO::FETCH_ASSOC);
        return $record;
    }
    
    public function setReadInbox($id)
    {
        $con = new Database();
        $db = $con->connect();
        $sth = $db->prepare("UPDATE inbox SET Processed='true' WHERE id=$id");
        $sth->execute();
    }

}

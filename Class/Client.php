<?php
    class Client
    {
        
        public function __construct()
        {

        }
                
        public function getClientPhone($kd_client)
        {
            $clientData = array (
                'kd_client'  => $kd_client,
            );
            $clientTable = new ClientTable();
            $data = $clientTable->findClient($clientData);
            return $data['no_telepon'];
        }
    }

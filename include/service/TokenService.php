<?php

class TokenService
{
    private $con;

    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }

    function __construct()
    {
        $db = new DbConnect();
        $this->con = $db->connect();
    }



    //Checking the student is valid or not by api key
    public function isValidToken($api_key) {
        $stmt = $this->con->prepare("SELECT id_personne from personne WHERE api_key like :api");
        $stmt->bindParam(":api", $api_key);
        $stmt->execute();
        $stmt->debugDumpParams();
        $num_rows = $stmt->rowCount();
        return $num_rows > 0;
    }

    public static function  creatToken($id){


        $token = array();
        $token['id'] = $id;
        $token['time'] = time();
        return JWT::encode($token, 'msyd');

    }




}
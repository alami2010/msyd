<?php

class PersonneService
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

    //Method to let a student log in
    public function login($username,$pass){
echo "dddddd";
echo "dddddd";
        echo $username;
        echo $pass;
        $password = md5($pass);
        $stmt = $this->con->prepare("SELECT * FROM personne WHERE email=? and password=?");
        $stmt->bind_param("ss",$username,$password);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows>0;
    }



}
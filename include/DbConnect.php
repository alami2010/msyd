<?php

//Class DbConnect
class DbConnect
{
    //Variable to store database link
    private $con;

    //Class constructor
    function __construct()
    {

    }

    //This method will connect to the database
    function connect()
    {
        //Including the constants.php file to get the database constants
        include_once dirname(__FILE__) . '/Constants.php';

        try {


            $dbhost     = DB_HOST;
            $dbname     = DB_NAME;
            $dbusername = DB_USERNAME;
            $dbpassword = DB_PASSWORD;

            $this->con = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbusername,$dbpassword);
        } catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
        }



        //Checking if any error occured while connecting
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        //finally returning the connection link
        return $this->con;
    }

}
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
        $password = md5($pass);
        $stmt = $this->con->prepare("SELECT * FROM personne WHERE email=:username and password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $num_rows = $stmt->rowCount();
        //$stmt->close();
        return $num_rows>0;
    }




    //Method to get personne details
    public function getPersonneByEmail($email){
        $stmt = $this->con->prepare("SELECT * FROM personne WHERE email=:username");
        $stmt->bindParam(':username', $email);
        $stmt->execute();
        $personne = $stmt->fetch(PDO::FETCH_ASSOC);
        unset($personne['PASSWORD']);
        //$stmt->close();
        return $personne;
    }


    //Method to get personne details
    public function getPersonneByID($id){

        $stmt = $this->con->prepare("SELECT * FROM personne WHERE id_personne=:id");
        $stmt->bindParam(':id', $id);;
        $stmt->execute();
        $personne = $stmt->fetch(PDO::FETCH_ASSOC);
        unset($personne['PASSWORD']);
        //$stmt->close();
        return $personne;
    }





    //Method to register a new personne
    public function createPersonne($nom,$prenom ,$email ,$tel,$password , $sexe ){

        $response = array();

        if (!$this->isPersonneExist($email)) {
            $password = md5($password);
            $apikey =  TokenService::creatToken($email);

            //NOM`, `PRENOM`, `EMAIL`, `TEL`, `PASSWORD`, `SEXE`


            $stmt = $this->con->prepare("INSERT INTO personne (nom, prenom, email,tel,password,sexe, api_key)
              values(:nom, :prenom , :email , :tel  , :password  , :sexe  , :apikey )");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':tel', $tel);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':sexe', $sexe);
            $stmt->bindParam(':apikey', $apikey);
            $stmt->bindParam(':email', $email);


            $result = $stmt->execute();
            if ($result) {
                $response['nom'] =$nom ;
                $response['prenom'] =$prenom ;
                $response['tel'] =$tel ;
                $response['password'] = $password;
                $response['sexe'] =$sexe ;
                $response['apikey'] =$apikey ;
                $response['email'] =$email ;
                $response['error'] = false;
                return $response;
            } else {
                $response['error'] = true;
                $response['message'] = "CREATE_ERROR";
                return $response;
            }
            } else {

            $response['error'] = true;
            $response['message'] = "EMAIL_ALREADY_EXIST";
            return $response;
        }
    }



    //Method to check the student username already exist or not
    private function isPersonneExist($email) {
        $stmt = $this->con->prepare("SELECT id_personne from personne WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $num_rows = $stmt->rowCount();
        return $num_rows > 0;
    }

    //Method to check the student username already exist or not
    public function updateTokenByid($id,$api) {
        $stmt = $this->con->prepare("update personne set api_key=:api WHERE id_personne = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':api', $api);
        $stmt->execute();
        $num_rows = $stmt->rowCount();
        return $num_rows > 0;
    }



}
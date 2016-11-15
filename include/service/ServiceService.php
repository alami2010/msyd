<?php
class ServiceService
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

    //Method to get personne details
    public function getServiceByID($id){
        $stmt = $this->con->prepare("SELECT * FROM service WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $personne = $stmt->fetch(PDO::FETCH_ASSOC);
        return $personne;
    }
    
    //Method to get personne details
    public function getAllServices(){
        $stmt = $this->con->prepare("SELECT * FROM service ");
        $stmt->execute();
        $personne = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $personne;
    }
    //Method to register a new personne
    public function createService($nom,$prenom ,$email ,$tel,$password , $sexe ){
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

}

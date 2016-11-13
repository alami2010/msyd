<?php
/**
 * Created by IntelliJ IDEA.
 * User: ydahar
 * Date: 10/11/2016
 * Time: 19:17
 */







/* *
 * URL: http://localhost/StudentApp/v1/login
 * Parameters: username, password
 * Method: POST
 * */


function loginPersonne () {
    verifyRequiredParams(array('email', 'password'));
    $app = \Slim\Slim::getInstance();
    $username = $app->request->post('email');
    $password = $app->request->post('password');
    $personneService = new PersonneService();

    $response = array();
    if ($personneService->login($username, $password)) {
        $response = $personneService->getPersonneByEmail($username);
        $response['error'] = false;
        $response['api_key'] = TokenService::creatToken($response['EMAIL']);
        $personneService->updateTokenByid($response['ID_PERSONNE'],$response['api_key'] );
    } else {
        $response['error'] = true;
        $response['message'] = "Invalid username or password";
    }
    //function decode($jwt, $key = null, $verify = true)
    // $tokenx = JWT::decode($okii, 'secret_server_key');
    echoResponse(200, $response);
}





/* *
 * URL: http://localhost/StudentApp/v1/user
 * Parameters: id
 * Method: GET
 * */


function getPersonne($user_id) {
    $loginService = new PersonneService();
    $response = $loginService->getPersonneByID($user_id);
    $response['error'] = false;
    echoResponse(200, $response);
}


/* *
 * URL: http://localhost/StudentApp/v1/user
 * Parameters: username, password
 * Method: POST
 * */
function createUser() {
    verifyRequiredParams(array('nom','prenom','email','sexe', 'password'));
    $personneService = new PersonneService();
    $app = \Slim\Slim::getInstance();

    $nom = $app->request->post('nom');
    $prenom = $app->request->post('prenom');
    $sexe = $app->request->post('sexe');
    $password = $app->request->post('password');
    $email = $app->request->post('email');
    $tel = $app->request->post('tel');



    $response = $personneService->createPersonne($nom,$prenom,$email,$tel,$password,$sexe);

    echoResponse(200, $response);
}



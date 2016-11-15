<?php
/**
 * Created by IntelliJ IDEA.
 * User: ydahar
 * Date: 10/11/2016
 * Time: 19:17
 */

 
function getAllServices() {
    $serviceService = new ServiceService();
    $response = $serviceService->getServices();
    $response['error'] = false;
    echoResponse(200, $response);
}

function getService($user_id) {
    $serviceService = new ServiceService();
    $response = $serviceService->getServiceByID($user_id);
    $response['error'] = false;
    echoResponse(200, $response);
}


function createService() {
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


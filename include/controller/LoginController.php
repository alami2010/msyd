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
$app->post('/login', function () use ($app) {
    verifyRequiredParams(array('username', 'password'));
    $username = $app->request->post('username');
    $password = $app->request->post('password');
    $loginService = new PersonneService();
    $response = array();
    if ($loginService->login($username, $password)) {
        $student = $loginService->getStudent($username);
        $response['error'] = false;
        $response['id'] = $student['id'];
        $response['name'] = $student['name'];
        $response['username'] = $student['username'];
        $response['apikey'] = $student['api_key'];
    } else {
        $response['error'] = true;
        $response['message'] = "Invalid username or password";
    }


    echo $username;
    echo $password;
    echo "eexe\n ";
    echoResponse(200, $response);
});











?>
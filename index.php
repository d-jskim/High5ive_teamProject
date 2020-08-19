<?php 
session_start();
require("./controller/controller.php");
$rawBody = file_get_contents("php://input");
$bodyArr = (array) json_decode($rawBody);
if(empty($bodyArr)) { $bodyArr =  $_REQUEST;}
try {
    if(isset($bodyArr['action'])) {
        if($bodyArr['action'] == 'login') {
            loginPage();
        } else if ($bodyArr['action'] == 'subscribeUser'){
            subscribeUser($bodyArr);
        } else if ($bodyArr['action'] == 'loginUser'){
            print_r($bodyArr);
            if(isset($bodyArr['username']) && isset($bodyArr['password'])) 
            {
                echo "this is loginUser action!!!!";
                $_SESSION['userId'] = $bodyArr['username'];
                $_SESSION['password'] = $bodyArr['password'];
                loginUser($bodyArr);
            } else {
                throw new Exception('Error: login error');
            }
        } else if($bodyArr['action'] == 'viewProfile') {
            if (isset($_SESSION['userId'])) {
                viewProfile($_SESSION['userId']);
            }
            
        } else if ($bodyArr['action'] == 'logoutUser') {
                logoutUser();
        } else if ($bodyArr['action'] == 'uploadImg') {
                $userId = $_SESSION['userId'];
                uploadImg($_FILES, $userId);
        } else if ($bodyArr['action'] == 'addMovie') {
                addMovie($bodyArr);
        } else if ($bodyArr['action'] == 'deleteMovie'){
                deleteMovie($bodyArr);
        } else if ($bodyArr['action'] == 'updateRanking'){
                updateRanking($bodyArr);
        }
    }
    else {
        loginPage();
    } 
}   
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    $errorFile = $e->getFile();
    require('./view/error.php');
}


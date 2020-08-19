<?php 
require_once('./model/ManagerUser.php');
require_once('./model/ManagerMovie.php');
require_once('UploadFiles.php');

function loginPage() {
    require_once("./view/login.php");
}
/**
 * connects user
 * @params mixed 
 * 
 * 
 * */ 
function loginUser($params){
    echo "!!! controller loginUser function!!!!";
    $managerUser = new ManagerUser();
    $userId = $managerUser->loginUser($params);
    if(isset($params['ajax'])) {
        echo $userId;
    } else if (isset($_SESSION['userId'])) {
        echo $_SESSION['userId'];
        header('Location: index.php?action=viewProfile');
    } else throw new Exception("Problem with login"); //or redirect to login pg and show message
}

function viewProfile($userId) {
    $managerUser = new ManagerUser();
    $user = $managerUser->getProfileUserData($userId);
    $managerMovie = new ManagerMovie();
    $dataMovie= $managerMovie->loadMovies($user['id']);
    require("./view/profile.php");
}
//TODO: CHECK & DEL
function loadProfile($postParams){
    $username = htmlspecialchars($postParams['username']);
    $password = htmlspecialchars($postParams['password']);
    // $userId = 1;
    // loadUserMovies($userId);
    // $dataUser = verifyUser($username, $password);
    // loadUserMovies($dataUser['userId'])

    require("./view/profile.php");
}

function addMovie($params) {
    //$params <== $bodyArr <== movieData of movieDB.js
    // $last_id = $managerMovie->addMovie($params);
    // $movie = $managerMovie->getNewMovie($last_id);
    // echo json_encode($movie);
    $managerMovie = new ManagerMovie();
    $last_id = $managerMovie->addMovie($params);
    $movie = $managerMovie->getNewMovie($last_id);
    echo json_encode($movie);   
}

function deleteMovie($params){
    echo "deleteMovie of controller";
    $managerMovie = new ManagerMovie();
    $managerMovie->deleteMovie($params);
}

function updateRanking($params){
    echo "updateRanking of controller";
    $managerMovie = new ManagerMovie();
    $managerMovie->updateRanking($params);
}

function subscribeUser($params) {
    $managerUser = new ManagerUser();
    $errors = $managerUser->subscribeUser($params);
    $location = "Location:index.php?action=login&";
    if($errors !== "success") {
        $location.="errors=".json_encode($errors);
    } else if ($errors == "success") {
        $location.="errors=success";
    }
    header($location);
}

function logoutUser() {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php');
}


function uploadImg($params, $userId) {
    echo "this is userId in uploadImg in controller.php";
    $uploadFiles = new UploadFiles();
    $fileDestination = $uploadFiles -> validateFiles($params);

    $managerUser = new ManagerUser($userId);
    $managerUser->uploadImg($fileDestination, $userId);

    header('Location: index.php?action=viewProfile');
}
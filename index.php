<?php 
require("./controller/controller.php");

try {
    if(isset($_GET['action'])) {
        if($_GET['action'] == 'login') {
            loginPage();
        } else if ($_GET['action'] == 'loginUser'){

            if(isset($_POST['username']) && isset($_POST['password'])) 
            {
                if(isset($_REQUEST)){
                    if(!empty($_POST['username']) && !empty($_POST['password'])) 
                    {
                        //call the controller     
                        loadProfile($_POST);
                    } else {
                        if($_REQUEST["socialM"]){
                            loginUser($_REQUEST);
                        }
                        else {
                            throw new Exception('Error: Please fill in username and password');
                        }   
                    }
                    
                } else{
                    throw new Exception('Error: problem with login');
                }
            }
        } else if($_GET['action'] == 'viewProfile') {
            if(isset($_GET['userId'])) {
                viewProfile($_GET['userId']);
            } else {
                echo "user not found";
            }
            
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


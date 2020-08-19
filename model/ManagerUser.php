<?php
require_once("Manager.php");
class ManagerUser extends Manager {
    protected $_userId;
    

    // function __construct($userId){
    //     parent::__construct();
    //     $this->_userId = $userId;
    // }
    function verifyUserClass($username) {
        $query = "SELECT id FROM users WHERE username = :username";
        $req = $this->_db->prepare($query);
        $req->execute(array('username' => $username));
        $result = $req->fetch();
        return ($result) ?  $result['id'] : false;
    }


    function verifyUser($username) {
        $bdd = $this->dbConnect();
        $query = "SELECT id FROM users WHERE username = :username";
        $req = $bdd->prepare($query);
        $req->execute(array('username' => $username));
        $result = $req->fetch();
        return ($result) ?  $result['id'] : false;
    }

    function loginUser($params){
        
        $username = isset($params['username']) ? htmlspecialchars($params['username']) : '';
        $socialM = isset($params['socialM']) ? $params['socialM'] : null;
        $userId = '';
        $bdd = $this->dbConnect();
        // do it the tests for the isset case normal FB and GMAIL
        if ($socialM) {
            if ($socialM == 'gmail') {
                $userId = $this->verifyUser($username);
                if(!$userId){
                    // user creation
                    $query = "INSERT INTO users(username, password, email, imageurl, google) VALUES(:username, :password, :email, :imageurl, 1)";
                    $req = $bdd->prepare($query);

                    $email = isset($params['email']) ? htmlspecialchars($params['email']) : '';
                    $password = isset($params['password']) ? htmlspecialchars($params['password']) : '';
                    $imageurl = isset($params['imageurl']) ? htmlspecialchars($params['imageurl']) : '';

                    $req->execute(array(
                        'username' => $username,
                        'password' => $password,
                        'email' => $email,
                        'imageurl' => $imageurl,
                    ));
                    //get user id
                    $userId = $this->verifyUser($username);
                }
                $_SESSION['userId'] = $userId;
            }// } else if ($socialM == 'fb') {
            //     //Jee Soo insert FB case here
            // }
        } else { //normal case check
            $req = $bdd->prepare("SELECT * FROM users WHERE username = :username");
            $req->execute(array(
                'username' => $username,
            ));
            $user = $req->fetch();
            $userId = $user['id'];
            
            //Confirm pw with db
            $isPasswordCorrect = password_verify($params['password'], $user['password']);
    
            //Start new session
            if($isPasswordCorrect) {
                $_SESSION['userId'] = $userId;
            } 
        }
        return $userId;
    } 

    function getProfileUserData($userId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare("SELECT * FROM users WHERE id = :id");
        $req->execute(array(
            'id' => $userId
        ));
        $user = $req->fetch();
        return $user;
    }

    function uploadImg($fileDestination, $userId){
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE users SET imageurl = :imageurl WHERE id = :userId");
        $req->execute(array(
            'imageurl' => $fileDestination,
            'userId' => $userId // give a default value at this moment
        ));        
    }
    function subscribeUser($params) {
        // Setting global variables for inputs to empty (prep for errors)
        $userErr = $emailErr = $passwordErr = "";
        $db = $this->dbConnect();

        // Get form info
        if (isset($params['username']) && isset($params['email']) && isset($params['password']) && isset($params['confirm'])) {
            $pwd = $params['password'];
            $confirm = $params['confirm'];
            $errors=[];
        
            if (empty($params['username'])) {
                $errors["username_required"] = "true";
            } else {
                $username = addslashes(htmlspecialchars(htmlentities(trim($params['username']))));
                if($this->verifyUser($username)){
                    $errors["used"] =  "true";
                }
            }
            if (empty($params['email'])) {
                $errors["email_required"] =  "true";
            } else {
                $email = addslashes(htmlspecialchars(htmlentities(trim($params['email']))));
                // check if email is well formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors["email_invalid"] =  "true";
                }
            }
            if (empty($params['password'])) {
                $errors["password_required"] = "true";
            } else {
                // Password Length 
                if(strlen($params['password']) <= 8) {
                    $errors["password_length"] = "true";
                }
                // REGEX 
                $regex = "#(?=.*\d)(?=.*[a-z])(?=.*[A-Z])#";
                if (!preg_match($regex, $params['password'])) {
                    $errors["password_character"] = "true";
                }

                // Passwords matches 
                // checking if matching passwords
                if ($pwd != $confirm) {
                    $errors["pwd_not_match"] =  "true";
                } 
                
            }

            if(count($errors)>0) {
               return $errors;
                // header("Location:index.php?action=login&errors=$str_errors");
            } else {
                // Hash of the password
                $pass_hache = password_hash($params['password'], PASSWORD_DEFAULT); 
                $req = $db->prepare('INSERT INTO users(username, password, email, normal) VALUES(:username, :password, :email, 1)');
                $req->execute(array(
                    'username' => $username,
                    'password' => $pass_hache,
                    'email'=> $email
                ));
                return "success";
            }
        }

    }

}

    


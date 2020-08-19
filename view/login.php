

<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <meta charset="utf-8" />
    <meta
      name="google-signin-client_id"
      content="856185366006-bbrto3am0gcfgd0qgrsodl6scame43ma.apps.googleusercontent.com"
    />
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <link rel="stylesheet" href="./public/style/login.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    
    <style>
    #socialLogin{
      display: "inline";
    }
    </style>
  </head>
  <body>
    <div class="container">
    <div class="slider-menu">
    <input type="range" min="0" max="1" value="0" class="range blue" id="slider"/>
    <br/>
    <ul>
        <li>Log in</li>
        <li>Sign Up</li>
    </ul>
    </div>
  <div class="row">
    <div class="column">
    <img src="./public/img/slides/1.jpg" class="overlayImg-left" id="overlay-img" />
    <section id='signIn'>
        <div class="header">
        <h1>Login</h1>
        </div>      
        <div id='normalLogin'>
            <!-- Steve -->
          <!-- Note to Nanee: Delete below test form when pull Steve's code here -->
          <?php
           if(isset ($_REQUEST['errors']) AND $_REQUEST['errors'] == true) {
               if($_REQUEST['errors'] == "success") {
                echo "
                <div id='successSubscribe'>
                    <span>Thank you for subscribing. Please Log in now </span>
                </div> ";
               } else {
                $errors = (array) json_decode($_REQUEST['errors']);
               }
              
           }
        ?>
          <form name="myForm" id="myForm" method="POST" action="index.php?action=loginUser">
            <input class="form-buttons" name="username" id="loginusername" type="text" placeholder="username"/><br></br>
            <input class="form-buttons" name="password" id="loginpassword" type="password" placeholder="password"/><br></br>
            <button name="submit" id="submit" type="submit">Login</button>
          </form>
        </div>

        
        <div id='socialLogin'>
          <div id="facebook">
          <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
          </fb:login-button>

          <div id="status">
          </div>
        </div>
          
            <div id="gmail">
                <!-- Nanee -->
        
                <h2>or sign in with Google:</h2><div class="g-signin2" data-onsuccess="onSignIn"></div>
                <a href="#" onclick="signOut();"></a>
            </div>
        </div>
      
    </section>
    </div>
    <div class="column">
    <img src="./public/img/slides/1.jpg" class="overlayImg" id="overlay-img" />
    <section id='signUp'>
        
        <div class="header">
        <h1>Sign Up</h1>
        </div>
        <!-- Charlie -->
        <form  action="index.php?action=subscribeUser" method="POST" id="registration">
            <div>
                <input class="form-buttons" type="text" id="username" placeholder="Your Username" name="username" autocomplete="off" placeholder="username"><br>
                <span class="error">
                    <?php
                    if (isset($errors['user_required'])) {
                        echo "User required";
                    } elseif(isset($errors['used'])) {
                        echo "User already used";
                    }
                    ?>
                </span>
            </div>
            <input class="form-buttons" type="text" id="email" placeholder="Your Email" name="email" autocomplete="off" placeholder="email"><br>
                <?php
                    if (isset($errors['email_required'])) {
                        echo "Email required";
                    } elseif(isset($errors['email_invalid'])) {
                        echo "Email invalid";
                    }
                ?>
            <br>
            <input class="form-buttons" type="password" id="password" placeholder="Your Password" name="password" autocomplete="off" placeholder="password"><br><br>
                <?php
                    if (isset($errors['password_required'])) {
                        echo "Password required";
                    } elseif(isset($errors['password_length'])) {
                        echo "Password too short";
                    } elseif(isset($errors["password_character"])) {
                        echo "Password requirements not met - Lowercase, Uppercase, Digit";
                    }
                ?>
            <br>
           <input class="form-buttons" type="password" id="confirm" placeholder="Confirm Password" name="confirm" autocomplete="off" placeholder="confirm password"><br>
                <?php
                    if (isset($errors['pwd_not_match'])) {
                        echo "Passwords do not match";
                    }
                ?>
            <br>
            <button name="submit" id="submit" type="submit">Sign Up</button><br><br>
        </form>

    </section>
    </div>
    </div>
    </div>
    <script src="./public/js/OAuth.js"></script>
    <script src="./public/js/slider.js"></script>
  </body>
</html>

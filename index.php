<?php
require('session.php');
require('user.php');
require('sanitize.php');

$user     = new User();

require_once 'csrf_request_type_functions.php';
require_once 'csrf_token_functions.php';


$action = (!empty($_POST['login']) && ($_POST['login'] === 'LOG IN')) ? 'login' : 'show_form';
switch ($action) {
    case 'login':
       
        
             $regdno   = sanitize($_POST['regdno']);
             $password = sanitize($_POST['password']);
             $passkey  = sanitize($_POST['passkey']);

             $username_sub = substr($regdno, 0, 10);
             $trim_user    = trim($username_sub);
             $get_int_user = (int) $trim_user;
             $regdno       = intval($get_int_user);
           

             $password_sub = substr($password, 0, 21);
             $trim_pass    = trim($password_sub);
             $password     = $trim_pass;
              
             $passkey_sub   = substr($passkey, 0, 25);
             $trim_pass_key = trim($passkey_sub);
             $passkey       = $trim_pass_key;
             

              if(request_is_post()) {
              if(csrf_token_is_valid()) {

                $message = "VALID FORM SUBMISSION";

                 if ($user->authenticate($regdno, $password, $passkey)) 
                  {
                      header('location: user/index.php');
                      exit;

                  }
                  else
                  {
                      $errorMessage = "WRONG CREDENTIALS";
                      break;
                  }


                if(csrf_token_is_recent()) {
                  $message .= " (recent)";
                } else {
                  $message .= " (not recent)";
                  die_on_csrf_token_failure();
                }
              } else {
                $message = "CSRF TOKEN MISSING OR MISMATCHED";
                die_on_csrf_token_failure();
              }
            } else {
              // form not submitted or was GET request
              $message = "Please login.";
            }           

       
    case 'show_form':
    default:

        $errorMessage = NULL;
}



        if($user->isLoggedIn())
        {
        
            header('location: user/index.php');
            exit;
        } 
    
?>
<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CodeCracker - Student Assessment Application</title>
       <script src="loadCSS/src/loadCSS.js"></script>
       <script>
          loadCSS("css/style1.css");
          loadCSS("css/autowide.css");
       </script>
    
      <style>
         #ershow
         {
         font-family: 'Audiowide', cursive;
         }
      </style>
   </head>
   <body>
   <?php

 
          if (isset($errorMessage)){
         echo "<center><p id='ershow' style='font-size:30px; color:#FFFF00;'>$errorMessage</p></center>";
         
         }

         ?>
         
        <center>
         <img src="images/logo.png" height="60" width="350" style="margin-top: 5px;">
        </center> 

      <div class="login-box">

         <form method="post" action="" id="login">
            <input type="number" autocomplete="off" min="1" max="9999999999"  class="text" placeholder="University Registration No." name="regdno"  required pattern="\S+" title="Universtiy Number is required">
            <input type="password" autocomplete="off" placeholder="Password" name="password" required pattern="\S+" title="Password is required (* Whitespace Not Allowed)">
            <input type="password" autocomplete="off" placeholder="Passkey" name="passkey" required pattern="\S+" title="Passkey is required (* Whitespace Not Allowed)">
              <?php echo csrf_token_tag(); ?>
            
            <input type="submit"  name="login" value="LOG IN" >
         </form>
         
         <div class="remember">
            <h4 style="color:#000;"><a href="register.php">New User?</a></h4>
         </div>

     </div>



	  <script src="js/jquery-3.1.0.min.js" async></script>
    <script src="js/disable.js" async></script>

      
   </body>
</html>
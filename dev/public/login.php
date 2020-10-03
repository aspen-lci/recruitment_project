<?php
require_once('../private/initialize.php');

if(is_post_request()){
  //echo "post request";
  
  $result = password_verify($_POST['password'], $_SESSION['password']);
  
  //echo gettype($_SESSION['user_type']);
  if($result){
    switch(intval($_SESSION['user_type'])){
      case 1;
      case 2;
      case 3:
        redirect_to(url_for('/hr/index.php'));
      break;
      case 4:
        redirect_to(url_for('/candidate/index.php'));
      break;
    } 
      
    
  }
  $_SESSION['message'] = "Log in failed.  Please try again." . $_SESSION['user_type'];
      
 redirect_to(url_for('index.php'));
}

?>

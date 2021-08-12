<?php
require_once('../private/initialize.php');

if(is_post_request()){
  //echo "post request";
  
  $result = password_verify($_POST['password'], $_SESSION['password']);
  
  //echo gettype($_SESSION['user_type']);
  if($result){
    switch(intval($_SESSION['user_type'])){
      case 1:
        $_SESSION['time_limit'] = 120*60;
        redirect_to(url_for('/hr/index.php'));
      case 2:
        $_SESSION['time_limit'] = 60*60;
        redirect_to(url_for('/recruiter/index.php'));
      case 3:
        $_SESSION['time_limit'] = 30*60;
        redirect_to(url_for('/hr/index.php'));
      break;
      case 4:
        $candidate = get_candidate_by_user_id($_SESSION['user_id']);
        $_SESSION['company_id'] = $candidate[0]['company_id'];
        $logo = get_logo_url($_SESSION['company_id']);
        $_SESSION['logo'] = $logo[0][logo_url];
        $_SESSION['intern'] = $candidate[0]['intern'];
        $_SESSION['time_limit'] = 20*60;

        if($_SESSION['intern'] == 1){
          redirect_to(url_for('/intern/index.php'));
        }else{
        redirect_to(url_for('/candidate/index.php'));
        }
      break;
      case 5:
        $_SESSION['time_limit'] = 60*60;
        redirect_to(url_for('/hr/index.php'));
      break;
      case 6:
        $manager = find_manager_by_id($_SESSION['user_id']);
        $_SESSION['position_id'] = $manager['position_id'];
        $_SESSION['time_limit'] = 60*60;
        redirect_to(url_for('/recruiter/index.php'));
      break;
      case 7:
        $_SESSION['time_limit'] = 60*60;
        redirect_to(url_for('/manager/index.php'));
      break;
    } 
      
    
  }
  $_SESSION['message'] = "Log in failed.  Please try again.";
      
 redirect_to(url_for('index.php'));
}

?>

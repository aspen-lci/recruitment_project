<?php
   require_once('../../../private/initialize.php');

    if(is_post_request()){
        $userID = $_GET['id'];
        
        $result = reset_password($userID);

        if($result===true){
            $_SESSION['message'] = "Password has been reset.";
            
        }else{
            $errors = $result;
            $_SESSION['message'] = "WARNING:  Password was not reset.";
        }
        redirect_to(url_for('hr/hr_users/index.php')); 
} else {
    redirect_to(url_for('/hr/hr_users/index.php'));
}
?>
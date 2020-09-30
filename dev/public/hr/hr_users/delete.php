<?php
   require_once('../../../private/initialize.php');

    if(is_post_request()){
        $userID = $_GET['id'];
        
        echo "<h1>Password Deleted</h1>";
   
} else {
    redirect_to(url_for('/hr/hr_users/index.php'));
}
?>
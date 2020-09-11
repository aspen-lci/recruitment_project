<?php
   require_once('../../../private/initialize.php');

    if(is_post_request()){
        

   $userName = $_POST['userName'];
   $password = $_POST['password'];
   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $userType = $_POST['userType'];
   $email = $_POST['email'];

   echo "Form parameters<br />";
   echo "User name: " . $userName . "<br />";
   echo "Password: " . $password . "<br />";
   echo "First name: " . $firstName . "<br />";
   echo "Last name: " . $lastName . "<br />";
   echo "User type: " . $userType . "<br />";
   echo "Email: " . $email . "<br />";
   
} else {
    redirect_to(url_for('/hr/hr_users/new.php'));
}
?>
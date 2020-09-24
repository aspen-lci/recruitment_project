<?php
   require_once('../../../private/initialize.php');

    if(is_post_request()){
        

   $firstName = $_POST['firstName'];
   $lastName = $_POST['lastName'];
   $email = $_POST['email'];
   $company = $_POST['company'];
   $position = $_POST['position'];
   $startDate = $_POST['startDate'];

   echo "Form parameters<br />";
   echo "First Name: " . $firstName . "<br />";
   echo "Last Name: " . $lastName . "<br />";
   echo "Email: " . $email . "<br />";
   echo "Company: " . $company . "<br />";
   echo "Position: " . $position . "<br />";
   echo "Start Date: " . $startDate . "<br />";
   
} else {
    redirect_to(url_for('/hr/hr_users/new.php'));
}
?>
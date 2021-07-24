<?php  
 //check_session.php  
 //session_start();
 if(time()-$_SESSION['login_timestamp'] < (.5*60))  
 {  
      echo '0';     //session not expired       
 }  
 else  
 {  
      echo '1';     //session expired  
 }
 ?>
<?php
    // Users
    function find_user_by_email($email){
        global $db;

        $sql = "SELECT * FROM users ";
        $sql .= "WHERE email='" . db_escape($db, $email) . "' "; 

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $user;
    }

?>
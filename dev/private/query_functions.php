<?php
    // Get user by email
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

// Get list of all users
    function all_users(){
        global $db;

        $sql = "SELECT * FROM users ";
        $sql .= "ORDER BY last_name ASC";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $user = resultToArray($result);
        mysqli_free_result($result);
        return $user;
    }

    function resultToArray($result) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

?>
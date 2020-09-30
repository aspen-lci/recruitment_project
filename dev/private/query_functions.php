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

        $sql = "SELECT * FROM users_roles ";
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

    function validate_user($user){
        $errors = [];

        if(is_blank($user['first_name'])){
            $errors[] = "First name cannot be blank.";
        } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 100))){
            $errors[] = "First name must be between 2 and 100 characters.";
        }

        if(is_blank($user['last_name'])) {
            $errors[] = "Last name cannot be blank.";
          } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 100))) {
            $errors[] = "Last name must be between 2 and 100 characters.";
          }

          if(is_blank($user['email'])) {
            $errors[] = "Email cannot be blank.";
          } elseif (!has_length($user['email'], array('max' => 100))) {
            $errors[] = "Email must be less than 100 characters.";
          } elseif (!has_valid_email_format($user['email'])) {
            $errors[] = "Email must be a valid format.";
          }

          if(is_blank($user['type'])) {
            $errors[] = "User type cannot be blank.";
          }

          return $errors;
    }

    function insert_user($user){
        global $db;

        $errors = validate_user($user);
            
            if (!empty($errors)) {
                return $errors;
            }
        
            $sql = "INSERT INTO users ";
            $sql .= "(first_name, last_name, email, type) ";
            $sql .= "VALUES (";
            $sql .= "'" . db_escape($db, $user['first_name']) . "',";
            $sql .= "'" . db_escape($db, $user['last_name']) . "',";
            $sql .= "'" . db_escape($db, $user['email']) . "',";
            $sql .= "'" . db_escape($db, $user['type']) . "'";
            $sql .= ")";

            $result = mysqli_query($db, $sql);

            if(!$result){
                echo mysqli_error($db);
                
            }
            db_disconnect($db);
            return $result;
    }

    function all_user_types(){
        global $db;

        $sql = "SELECT * FROM roles ";
        $sql .= "ORDER BY role ASC";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $roles = resultToArray($result);
        mysqli_free_result($result);
        return $roles;
    }

    function validate_password($password, $confirm_password){
        
        $errors = [];

        if(is_blank($password)) {
            $errors[] = "Password cannot be blank.";
          } elseif (!has_length($password, array('min' => 12))) {
            $errors[] = "Password must contain 12 or more characters";
          } elseif (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Password must contain at least 1 uppercase letter";
          } elseif (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Password must contain at least 1 lowercase letter";
          } elseif (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Password must contain at least 1 number";
          } elseif (!preg_match('/[^A-Za-z0-9\s]/', $password)) {
            $errors[] = "Password must contain at least 1 symbol";
          }
    
          if(is_blank($confirm_password)) {
            $errors[] = "Confirm password cannot be blank.";
          } elseif ($password !== $confirm_password) {
            $errors[] = "Password and confirm password must match.";
          }
          return $errors;
        }

    function set_password($password, $confirm_password, $email){
        global $db;

        $errors = validate_password($password, $confirm_password);
        if (!empty($errors)) {
            return $errors;
          }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
  
            $sql = "UPDATE users SET ";
            $sql .= "password='" . db_escape($db, $hashed_password) . "' ";
            $sql .= "WHERE email='" . db_escape($db, $email) . "' ";
            $sql .= "LIMIT 1";
            echo $sql;
            $result = mysqli_query($db, $sql);

            if(!$result){
                echo mysqli_error($db);
                
            }
            db_disconnect($db);
            return $result;
        

    }

?>
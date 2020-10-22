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

    function all_companies(){
      global $db;

      $sql = "SELECT * FROM companies ";
      $sql .= "ORDER BY company ASC";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $companies = resultToArray($result);
      mysqli_free_result($result);
      return $companies;
    }

    function all_positions(){
      global $db;

      $sql = "SELECT * FROM positions ";
      $sql .= "ORDER BY title ASC";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $positions = resultToArray($result);
      mysqli_free_result($result);
      return $positions;
  }

  function all_regions(){
    global $db;

    $sql = "SELECT * FROM regions ";
    $sql .= "ORDER BY name ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $regions = resultToArray($result);
    mysqli_free_result($result);
    return $regions;
  }

  function all_recruiters(){
    global $db;

    $sql = "SELECT * FROM recruiters ";
    $sql .= "ORDER BY first_name ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $recruiters = resultToArray($result);
    mysqli_free_result($result);
    return $recruiters;
  }

  function all_status(){
    global $db;

    $sql = "SELECT * FROM status ";
    $sql .= "ORDER BY id ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $status = resultToArray($result);
    mysqli_free_result($result);
    return $status;
  }

  function all_ii_dates(){
    global $db;

    $sql = "SELECT * FROM ii_dates ";
    $sql .= "WHERE date >= CURRENT_DATE() ";
    $sql .= "ORDER BY date ASC";
echo $sql;
    $result = mysqli_query($db, $sql);

    confirm_result_set($result);
    $dates = resultToArray($result);
    mysqli_free_result($result);
    return $dates;
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

    function validate_candidate($candidate){
      $errors = [];

      $errors = validate_user($candidate);

      if (!empty($errors)) {
        return $errors;
    }


  }

  function insert_candidate($candidate){
    global $db;

    $errors = validate_candidate($candidate);
        
        if (!empty($errors)) {
            return $errors;
        }
      mysqli_begin_transaction($db);

        // could use sprintf("'%s','%s',%d", 'string1', 'string2', 1) also
        $sql = "REPLACE INTO users ";
        $sql .= "(first_name, last_name, email, type) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $candidate['first_name']) . "',";
        $sql .= "'" . db_escape($db, $candidate['last_name']) . "',";
        $sql .= "'" . db_escape($db, $candidate['email']) . "',";
        $sql .= db_escape($db, $candidate['type']);
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if(!$result){
            echo mysqli_error($db);
            
        }

        $new_id = mysqli_insert_id($db);
        
      

        $sql = "INSERT INTO candidates ";
        $sql .= "(user_id, recruiter_id, company_id, position_id, region_id, start_date, interview_date, interview_time, ii_date) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $new_id) . "',";
        $sql .= "'" . db_escape($db, $candidate['recruiter']) . "',";
        $sql .= "'" . db_escape($db, $candidate['company']) . "',";
        $sql .= "'" . db_escape($db, $candidate['position']) . "',";
        $sql .= "'" . db_escape($db, $candidate['region']) . "',";
        $sql .= "'" . db_escape($db, $candidate['start_date']) . "',";
        $sql .= "'" . db_escape($db, $candidate['interview_date']) . "',";
        $sql .= "'" . db_escape($db, $candidate['interview_time']) . "',";
        $sql .= "'" . db_escape($db, $candidate['ii_date']) . "'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if(!$result){
          echo mysqli_error($db);
        }
        $candidate_id = mysqli_insert_id($db);

        $sql = "INSERT INTO document_status ";
        $sql .= "(candidate_id, document_id, status_id) ";
        $sql .= "VALUES (";
        $sql .= "'" . $candidate_id . "', ";
        $sql .= "'" . $candidate['jd_doc_id'] . "', ";
        $sql .= "1), ";
        $sql .= "(";
        $sql .= "'" . $candidate_id . "', ";
        $sql .= "4, 1), ";
        $sql .= "(";
        $sql .= "'" . $candidate_id . "', ";
        $sql .= "5, 1), ";
        $sql .= "(";
        $sql .= "'" . $candidate_id . "', ";
        $sql .= "6, 1)";
echo $sql;
        $result = mysqli_query($db, $sql);

        if(!$result){
          echo mysqli_error($db);
        }

        mysqli_commit($db);
        db_disconnect($db);

        return $result;
}

  function candidates_by_recruiter($recruiter_id){
    global $db;

    $sql = "SELECT * FROM recruiter_candidate_view ";
    $sql .= "WHERE recruiter_id='" . db_escape($db, $recruiter_id) . "' ";
    $sql .= "AND disposition <> 'Inactive' ";
    $sql .= "ORDER BY last_name ASC";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $candidates = resultToArray($result);
    mysqli_free_result($result);
    return $candidates;
}

function get_candidate_by_id($id){
  global $db;

  $sql = "SELECT * FROM full_candidate_view ";
  $sql .= "WHERE candidate_id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $candidate = resultToArray($result);
  mysqli_free_result($result);
  return $candidate;
}

function all_candidates(){
  global $db;

    $sql = "SELECT * FROM all_candidate_doc_status ";
    $sql .= "WHERE disposition <> 'Inactive'";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $candidates = resultToArray($result);
    mysqli_free_result($result);
    return $candidates;
}

function documents_by_candidate($candidate_id){
  global $db;

  $sql = "SELECT * FROM candidate_documents_view ";
  $sql .= "WHERE candidate_id='" . db_escape($db, $candidate_id) . "'";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $documents = resultToArray($result);
  mysqli_free_result($result);
  return $documents;
}

function edit_candidate_recruiter($data_set){
  global $db;

  $sql = "UPDATE users SET ";
            $sql .= "first_name='" . db_escape($db, $data_set['first_name']) . "', ";
            $sql .= "last_name='" . db_escape($db, $data_set['last_name']) . "', ";
            $sql .= "email='" . db_escape($db, $data_set['email']) . "' ";
            $sql .= "WHERE id='" . db_escape($db, $data_set['user_id']) . "' ";
            $sql .= "LIMIT 1; ";
            echo $sql;
            $result = mysqli_query($db, $sql);

            if(!$result){
                echo mysqli_error($db);
                
            }
            
            $sql = "UPDATE candidates SET ";
            $sql .= "recruiter_id='" . db_escape($db, $data_set['recruiter']) . "', ";
            $sql .= "company_id='" . db_escape($db, $data_set['company']) . "', ";
            $sql .= "position_id='" . db_escape($db, $data_set['position']) . "', ";
            $sql .= "interview_date='" . db_escape($db, $data_set['interview_date']) . "', ";
            $sql .= "interview_time='" . db_escape($db, $data_set['interview_time']) . "', ";
            $sql .= "start_date='" . db_escape($db, $data_set['start_date']) . "', ";
            $sql .= "ii_date='" . db_escape($db, $data_set['ii_date']) . "' ";
            $sql .= "WHERE id='" . db_escape($db, $data_set['candidate_id']) . "' ";
            $sql .= "LIMIT 1";
            echo $sql;
            $result = mysqli_query($db, $sql);

            if(!$result){
                echo mysqli_error($db);
                
            }
            db_disconnect($db);
            return $result;
}

function edit_candidate_hr($data_set){
  global $db;

  $sql = "UPDATE users SET ";
            $sql .= "first_name='" . db_escape($db, $data_set['first_name']) . "', ";
            $sql .= "last_name='" . db_escape($db, $data_set['last_name']) . "', ";
            $sql .= "email='" . db_escape($db, $data_set['email']) . "' ";
            $sql .= "WHERE id='" . db_escape($db, $data_set['user_id']) . "' ";
            $sql .= "LIMIT 1; ";
            echo $sql;
            $result = mysqli_query($db, $sql);

            if(!$result){
                echo mysqli_error($db);
                
            }
            
            $sql = "UPDATE candidates SET ";
            $sql .= "recruiter_id='" . db_escape($db, $data_set['recruiter']) . "', ";
            $sql .= "disposition_id='" . db_escape($db, $data_set['disposition']) . "', ";
            $sql .= "company_id='" . db_escape($db, $data_set['company']) . "', ";
            $sql .= "position_id='" . db_escape($db, $data_set['position']) . "', ";
            $sql .= "interview_date='" . db_escape($db, $data_set['interview_date']) . "', ";
            $sql .= "interview_time='" . db_escape($db, $data_set['interview_time']) . "', ";
            $sql .= "start_date='" . db_escape($db, $data_set['start_date']) . "', ";
            $sql .= "ii_date='" . db_escape($db, $data_set['ii_date']) . "' ";
            $sql .= "WHERE id='" . db_escape($db, $data_set['candidate_id']) . "' ";
            $sql .= "LIMIT 1";
            echo $sql;
            $result = mysqli_query($db, $sql);

            if(!$result){
                echo mysqli_error($db);
                
            }
            db_disconnect($db);
            return $result;
}

function get_jd_doc_id($position_id){
  global $db;

  $sql = "SELECT jd_doc_id FROM positions ";
  $sql .= "WHERE id='" . $position_id . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  confirm_result_set($result);
  $jd_doc_id_set = resultToArray($result);
  
  mysqli_free_result($result);
  db_disconnect($db);
  return $jd_doc_id_set;
}


?>

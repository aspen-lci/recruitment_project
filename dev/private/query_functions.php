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

    //Get user by id
    function find_user_by_id($id){
      global $db;

        $sql = "SELECT * FROM users_roles ";
        $sql .= "WHERE user_id='" . db_escape($db, $id) . "' "; 

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
                $result = mysqli_error($db);
                
            }
            db_disconnect($db);
            return $result;
    }

    function update_user($user_set){
      global $db;

      $sql = "UPDATE users SET ";
      $sql .= "first_name='" . db_escape($db, $user_set['first_name']) . "', ";
      $sql .= "last_name='" . db_escape($db, $user_set['last_name']) . "', ";
      $sql .= "email='" . db_escape($db, $user_set['email']) . "', ";
      $sql .= "type='" . db_escape($db, $user_set['type']) . "' ";
      $sql .= "WHERE id=" . $user_set['id'];
      
      $result = mysqli_query($db, $sql);

      if(!$result){
          return mysqli_error($db);
          
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

    function get_company_by_id($id){
      global $db;

      $sql = "SELECT * FROM companies ";
      $sql .= "WHERE id=" . $id . " ";
      $sql .= "LIMIT 1";

      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $company = resultToArray($result);
      mysqli_free_result($result);
      return $company;
    }

    function update_company($company){
      global $db;

      $sql = "UPDATE companies SET ";
      $sql .= "company='" . $company['company'] . "', ";
      $sql .= "logo_url='" . h($company['logo_url']) . "' ";
      $sql .= "WHERE id=" . $company['id'] . " ";
      $sql .= "LIMIT 1";
echo $sql;
      $result = mysqli_query($db, $sql);

        if(!$result){
          
          echo mysqli_error($db);
          
        }
        return $result;
    }

    function create_company($company){
      global $db;

      $sql = "REPLACE INTO companies ";
      $sql .= "(company, logo_url) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $company['company']) . "', ";
      $sql .= "'" . db_escape($db, $company['logo_url']) . "')";
echo $sql;
      $result = mysqli_query($db, $sql);

      if(!$result){
        echo mysqli_error($db);
      }
      return $result; 
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
    $sql .= "WHERE inactive=0 ";
    $sql .= "ORDER BY id ASC";
    
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

 function all_dispositions(){
    global $db;

    $sql = "SELECT * FROM dispositions";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $dispositions = resultToArray($result);
    mysqli_free_result($result);
    return $dispositions;
  }

  function all_doc_status(){
    global $db;

    $sql = "SELECT * FROM doc_status_view";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $doc_status = resultToArray($result);
    mysqli_free_result($result);
    return $doc_status;
  }

  function all_ii_dates(){
    global $db;

    $sql = "SELECT * FROM ii_dates ";
    $sql .= "WHERE date >= CURRENT_DATE() ";
    $sql .= "ORDER BY date ASC";

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
echo($result);
        if(!$result){
            mysqli_rollback($db);
            return (mysqli_error($db));
            exit;
            
        }

        $new_id = mysqli_insert_id($db);
        
        $sql = "REPLACE INTO candidates ";
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
        echo $sql;
        $result = mysqli_query($db, $sql);

        if(!$result){
          mysqli_rollback($db);
          echo mysqli_error($db);
        }

        $candidate_id = mysqli_insert_id($db);
        $doc_defaults = get_doc_defaults($candidate['company']);

        $sql = "INSERT INTO document_status ";
        $sql .= "(candidate_id, document_id, status_id) ";
        $sql .= "VALUES ";
       

        foreach($doc_defaults as $default){
        $sql .= "(";
        $sql .= $candidate_id . ",";
        $sql .= $default['document_id'] . "," . $default['default_status'] . "), ";
        }

        $sql .= "(";
        $sql .= $candidate_id . ", ";
        $sql .= $candidate['jd_doc_id'] . ", ";
        $sql .= "1)";
        echo $sql;
        $result = mysqli_query($db, $sql);

        if(!$result){
          mysqli_rollback($db);
          echo mysqli_error($db);
        }

        mysqli_commit($db);
        
        return $result;
}

function get_doc_defaults($company_id){
  global $db;

  $sql = "SELECT * FROM document_defaults ";
  $sql .= "WHERE company_id='" . $company_id . "'";

  $result = mysqli_query($db, $sql);

  if(!$result){
    echo mysqli_error($db);
  }

  return $result;
}

  function candidates_by_recruiter($recruiter_id){
    global $db;

    $sql = "SELECT * FROM all_candidate_doc_status ";
    $sql .= "WHERE recruiter_id='" . db_escape($db, $recruiter_id) . "' ";
    $sql .= "AND disposition <> 'Inactive' ";
    $sql .= "AND inactive = 0 ";
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

function get_candidate_by_user_id($user_id){
  global $db;

  $sql = "SELECT * FROM full_candidate_view ";
  $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' ";
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
    $sql .= "WHERE inactive = 0";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $candidates = resultToArray($result);
    mysqli_free_result($result);
    return $candidates;
}

function documents_by_candidate($candidate_id){
  global $db;

  $sql = "SELECT document_id, is_jd, status_id, status, signed_link FROM candidate_documents_view ";
  $sql .= "WHERE candidate_id='" . db_escape($db, $candidate_id) . "' ";
  $sql .= "AND inactive=0";

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
            $sql .= "last_name='" . db_escape($db, $data_set['last_name']) . "' ";
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
            $sql .= "region_id='" . db_escape($db, $data_set['region']) . "', ";
            $sql .= "ii_date='" . db_escape($db, $data_set['ii_date']) . "' ";
            $sql .= "WHERE id='" . db_escape($db, $data_set['candidate_id']) . "' ";
            $sql .= "LIMIT 1";
            echo $sql;
            $result = mysqli_query($db, $sql);

            if(!$result){
                echo mysqli_error($db);
                
            }
           
            return $result;
}

function edit_candidate_hr($data_set, $doc_set, $jd_id){
  global $db;

  mysqli_begin_transaction($db);
            $sql = "UPDATE users SET ";
            $sql .= "first_name='" . db_escape($db, $data_set['first_name']) . "', ";
            $sql .= "last_name='" . db_escape($db, $data_set['last_name']) . "' ";
            $sql .= "WHERE id='" . db_escape($db, $data_set['user_id']) . "' ";
            $sql .= "LIMIT 1; ";
            
            $result = mysqli_query($db, $sql);

            if(!$result){
              mysqli_rollback($db);
              echo mysqli_error($db);
                
            }
            
            $sql = "UPDATE candidates SET ";
            $sql .= "recruiter_id='" . db_escape($db, $data_set['recruiter']) . "', ";
            $sql .= "disposition_id='" . db_escape($db, $data_set['disposition']) . "', ";
            $sql .= "company_id='" . db_escape($db, $data_set['company']) . "', ";
            $sql .= "position_id='" . db_escape($db, $data_set['position']) . "', ";
            $sql .= "interview_date='" . db_escape($db, $data_set['interview_date']) . "', ";
            $sql .= "interview_time='" . db_escape($db, $data_set['interview_time']) . "', ";
            $sql .= "region_id='" . db_escape($db, $data_set['region']) . "', ";
            $sql .= "ii_date='" . db_escape($db, $data_set['ii_date']) . "' ";
            $sql .= "WHERE id='" . db_escape($db, $data_set['candidate_id']) . "' ";
            $sql .= "LIMIT 1";
            
            $result = mysqli_query($db, $sql);

            if(!$result){
              mysqli_rollback($db);
              echo mysqli_error($db); 
            }

           $result = update_doc_status($data_set['candidate_id'], $jd_id, $doc_set['jd']);

            if(!$result){
              echo mysqli_error($db); 
            }

            $result = update_doc_status($data_set['candidate_id'], 4, $doc_set['disc']);

            if(!$result){
              echo mysqli_error($db); 
            }

            $result = update_doc_status($data_set['candidate_id'], 5, $doc_set['lea']);

            if(!$result){
              echo mysqli_error($db); 
            }

            $result = update_doc_status($data_set['candidate_id'], 6, $doc_set['bcg']);

            if(!$result){
              echo mysqli_error($db); 
            }

            $result = update_doc_status($data_set['candidate_id'], 13, $doc_set['panel']);

            if(!$result){
              echo mysqli_error($db); 
            }

            $result = update_doc_status($data_set['candidate_id'], 7, $doc_set['offer']);

            if(!$result){
              echo mysqli_error($db); 
            }

            $result = update_doc_status($data_set['candidate_id'], 8, $doc_set['trans']);

            if(!$result){
              echo mysqli_error($db); 
            }

            $result = update_doc_status($data_set['candidate_id'], 9, $doc_set['fprint']);

            if(!$result){
              echo mysqli_error($db); 
            }

            $result = update_doc_status($data_set['candidate_id'], 10, $doc_set['ref']);

            if(!$result){
              echo mysqli_error($db); 
            }

            $result = update_doc_status($data_set['candidate_id'], 11, $doc_set['ultipro']);

            if(!$result){
              echo mysqli_error($db); 
            }
    
    mysqli_commit($db);
  return $result;
}

function update_doc_status($candidate_id, $doc_id, $status){
  global $db;

  $sql = "UPDATE document_status SET ";
  $sql .= "status_id=" . $status . " ";
  $sql .= "WHERE candidate_id=" . $candidate_id . " ";
  $sql .= "AND document_id=" . $doc_id . " ";
  $sql .= "LIMIT 1";
  
  $result = mysqli_query($db, $sql);

  if(!$result){
    echo mysqli_error($db);
    
  }
  
  return $result;

}

function get_jd_doc_id($position_id){
  global $db;

  $sql = "SELECT jd_doc_id FROM positions ";
  $sql .= "WHERE id=" . $position_id . " ";

  $result = mysqli_query($db, $sql);

  
  confirm_result_set($result);
  $doc_id = resultToArray($result);
 
  mysqli_free_result($result);
 
  return $doc_id;
}

function get_templates(){
 global $db;
 
 $sql = "SELECT * FROM documents";
 
 $result = mysqli_query($db, $sql);

 confirm_result_set($result);
 $docs_info = resultToArray($result);
 
 mysqli_free_result($result);
 
 return $docs_info;


}

function update_document_links($candidate_id, $jd_id, $links){
  global $db;

  $sql = "";

  if(!is_blank($links['jd'])){
    $sql .= "UPDATE document_status SET ";
    $sql .= "signed_link='" . db_escape($db, $links['jd']) . "' ";
    $sql .= "WHERE candidate_id='" . $candidate_id . "' ";
    $sql .= "AND document_id='" . $jd_id . "' ";
  }

  if(!is_blank($links['disc'])){
    $sql .= "UPDATE document_status SET ";
    $sql .= "signed_link='" . db_escape($db, $links['disc']) . "' ";
    $sql .= "WHERE candidate_id='" . $candidate_id . "' ";
    $sql .= "AND document_id='" . 4 . "' ";
    }

  if(!is_blank($links['lea'])){
    $sql .= "UPDATE document_status SET ";
    $sql .= "signed_link='" . db_escape($db, $links['lea']) . "' ";
    $sql .= "WHERE candidate_id='" . $candidate_id . "' ";
    $sql .= "AND document_id='" . 5 . "' ";
    }

  if(!is_blank($links['bcg'])){
    $sql .= "UPDATE document_status SET ";
    $sql .= "signed_link='" . db_escape($db, $links['bcg']) . "' ";
    $sql .= "WHERE candidate_id='" . $candidate_id . "' ";
    $sql .= "AND document_id='" . 6 . "' ";
    }
  
  if(!is_blank($sql)){
    $result = mysqli_query($db, $sql);
  
    if(!$result){
      echo mysqli_error($db);
    }

  return $result;
  } else {
    return;
  }
}

function make_doc_inactive($candidate_id, $doc_id){
  global $db;

  $sql = "UPDATE document_status SET ";
  $sql .= "inactive=1 ";
  $sql .= "WHERE candidate_id=" . $candidate_id . " ";
  $sql .= "AND document_id=" . $doc_id;

  $result = mysqli_query($db, $sql);

  if(!$result){
    echo mysqli_error($db);
  }

  return $result;
}

function make_doc_active($candidate_id, $doc_id){
  global $db;

  $sql = "UPDATE document_status SET ";
  $sql .= "inactive=0 ";
  $sql .= "WHERE candidate_id=" . $candidate_id . " ";
  $sql .= "AND document_id=" . $doc_id;

  $result = mysqli_query($db, $sql);

  if(!$result){
    echo mysqli_error($db);
  }

  return $result;
}

function add_new_jd($candidate_id, $document_id){
        global $db;
  
        $sql = "INSERT INTO document_status ";
        $sql .= "(candidate_id, document_id) ";
        $sql .= "VALUES (";
        $sql .= $candidate_id . ",";
        $sql .= $document_id . ")";
        
        $result = mysqli_query($db, $sql);

        if(!$result){
          echo mysqli_error($db);
        }

        return $result;
}

function get_jd_status($candidate_id, $jd_id){
  global $db;

  $sql = "SELECT status_id FROM document_status ";
  $sql .= "WHERE candidate_id=" . $candidate_id . " ";
  $sql .= "AND document_id=" . $jd_id;
  echo $sql;
  $result = mysqli_query($db, $sql);

  confirm_result_set($result);
  $jd_status = resultToArray($result);
  
  mysqli_free_result($result);
  
  return $jd_status;

}

function reset_password($user_id){
  global $db;

  $sql = "UPDATE users SET ";
  $sql .= "password=NULL ";
  $sql .= "WHERE id=" . $user_id;
  $sql .= " LIMIT 1";

  $result = mysqli_query($db, $sql);

  if(!$result){
    echo mysqli_error($db);
  }

  return $result;
 }

 function change_user_status($user_id, $status){
   global $db;

   if($status == 0){
     $sql = "UPDATE users SET ";
     $sql .= "inactive=1 ";
     $sql .= "WHERE id=" . $user_id;
     $sql .= " LIMIT 1";

     $result = mysqli_query($db, $sql);

      if(!$result){
        echo mysqli_error($db);
      }
    } 
    
    if($status == 1){
      $sql = "UPDATE users SET ";
      $sql .= "inactive=0 ";
      $sql .= "WHERE id=" . $user_id;
      $sql .= " LIMIT 1";
      
      $result = mysqli_query($db, $sql);

      if(!$result){
        echo mysqli_error($db);
      }
    }
      
   return $result;

 }

 function make_candidate_active($user_id){
    global $db;

    $sql = "UPDATE candidates SET ";
    $sql .= "disposition_id=1 ";
    $sql .= "WHERE user_id=" . $user_id;

    $result = mysqli_query($db, $sql);

    if(!$result){
      echo mysqli_error($db);
  }

  return $result;
}

function get_zoom_link($region_id){
  global $db;

  $sql = "SELECT zoom_link ";
  $sql .= "FROM regions ";
  $sql .= "WHERE id=" . $region_id;

  $result = mysqli_query($db, $sql);

  confirm_result_set($result);
  $zoom = resultToArray($result);
  mysqli_free_result($result);

  return $zoom;
}

//get a list of all documents used for candidates

function all_documents(){

  global $db;

  $sql = "SELECT * FROM documents";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $documents = resultToArray($result);
  mysqli_free_result($result);
  return $documents;
}

function get_document_by_id($id){
  global $db;

  $sql = "SELECT * FROM documents ";
  $sql .= "WHERE id=" . $id;

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $document = resultToArray($result);
  mysqli_free_result($result);
  return $document;
}
 
function update_document($document){
  global $db;

  $sql = "UPDATE documents SET ";
  $sql .= "description='" . h($document['description']) . "', ";
  $sql .= "is_jd='" . h($document['is_jd']) . "', ";
  $sql .= "template_link='" . h($document['template_link']) . "' ";
  $sql .= "WHERE id='" . $document['id'] . "' ";
  $sql .= "LIMIT 1";
echo $sql;
  $result = mysqli_query($db, $sql);

    if(!$result){
      
      echo mysqli_error($db);
      
    }
    return $result;
}

function create_document($document){
  global $db;

  $sql = "REPLACE INTO documents ";
  $sql .= "(description, is_jd, template_link) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $document['description']) . "', ";
  $sql .= "'" . db_escape($db, $document['is_jd']) . "', ";
  $sql .= "'" . db_escape($db, $document['template_link']) . "')";
echo $sql;
  $result = mysqli_query($db, $sql);

  if(!$result){
    echo mysqli_error($db);
  }
  return $result; 
}

function get_position_id($user_id){
  global $db;

  $sql = "SELECT position_id FROM full_candidate_view ";
  $sql .= "WHERE user_id='" . db_escape($db, $user_id) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $position = resultToArray($result);
  mysqli_free_result($result);
  
  return $position;

}

?>

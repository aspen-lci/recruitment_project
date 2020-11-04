
<?php

function url_for($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
      $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
  }

function u($string=""){
  return urlencode($string);
}

function raw_u($string=""){
  return rawurlencode($string);
}

function h($string=""){
  return htmlspecialchars($string);
}

function error_404(){
  header($_SERVER["SERVER_PROTOCOL"] . "404 Not Found");
  exit();
}

function error_500(){
  header($_SERVER["SERVER_PROTOCOL"] . "500 Internal Server Error");
  exit();
}

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

function is_post_request(){
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request(){
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

//Custom functions

function checkmark($var){
  $cmark = '<i class="fas fa-check"></i>';
  if ($var == 'true'){
    return $cmark;
  } 
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors col-lg-6 offset-lg-3\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}
function get_and_clear_session_message() {
  if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    return $msg;
  }
}

function display_session_message() {
  $msg = get_and_clear_session_message();
  if(!empty($msg)) {
    return '<div class="col-lg-10 offset-lg-1" id="message">' . h($msg) . '</div>';
  }
}

// Convert date coming from database to typical MM-DD-YYYY format
function convert_date($date){
  $newDate = date('m-d-Y', strtotime($date));
  return $newDate;
}

// Convert time from db to 12 hour format
function convert_time($time){
  $newTime = date("g:i a", strtotime($time));
  return $newTime;
}

function document_in_document_list($documents_list, $id){
  foreach ($documents_list as $document){
    if ($document['document_id'] === $id) return $document['status'];
  }
  return;
}

function get_job_desc($documents_list){
  foreach($documents_list as $document){
    if($document['is_jd'] == 1){
      
      return $document['status'];
    }
    
  }
  return;
}

function get_jd_link($documents_list){
  foreach($documents_list as $document){
    if($document['is_jd'] == 1){
      return $document['signed_link'];
    }
    
  }
  return;
}

function get_doc_link($documents_list, $doc_id){
  foreach($documents_list as $document){
    if($document['document_id'] == $doc_id){
      return $document['signed_link'];
    }
    
  }
  return "";
}

function add_doc_link($link){
  if (!is_blank($link)) {
    return '<button class="btn btn-primary" type="button" onclick="location.href=\'' . $link . '\';" target="_blank">Document Link</button>';
  }
  return;
}

function get_template_link($templates, $doc_id){
  foreach($templates as $template){
    if($template['id'] == $doc_id){
      return $template['template_link'];
    }
   
  }

}

function box_visibility($documents_list, $doc_id){
  foreach($documents_list as $document){
    if($document['document_id']  === $doc_id){
      if(intval($document['status_id']) === 14){
        $visibility = 'none';
        return $visibility;
      }
      
    }
  } 
  $visibility = 'inherit';
    return $visibility;
}

function card_body_status($documents_list, $doc_id){
  foreach($documents_list as $document){
    if($document['document_id']  == $doc_id){
      if(intval($document['status_id']) > 1 && !14){
        return 'style="display: none;"';
      }
    }
  } return;
  }

  function display_card_body_status($documents_list, $doc_id){
    foreach($documents_list as $document){
      if($document['document_id']  == $doc_id){
        if($document['status_id'] == 1){
          return 'style="color: red; display: none;"';
        }
      }
    } return;
    }

    function jd_in_doc_list($documents_list, $jd_id){
      foreach($documents_list as $document){
        if($document['document_id'] == $jd_id){
          return true;
        }
      }
      return false;
    }

?>


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
    if($document['is_jd'] === 1){
      $jd = document_in_document_list($documents_list, $document['document_id']);
      return $jd;
    }
    return;
  }
}



?>

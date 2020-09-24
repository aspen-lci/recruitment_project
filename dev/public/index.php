<?php require_once('../private/initialize.php'); 

if(is_post_request()) {

    $email = $_POST['email'];
    $submitted_password = $_POST['password'] ?? "";
    $confirm_password = $_POST['confirm_password'] ?? "";
    $user = find_user_by_email($email);
    
    if (empty($user)){
        $_SESSION['message'] = "Email not found.  Please contact your recruiter.";
        redirect_to(url_for('index.php'));
    }
    
    $_SESSION['email'] = $email;
    $_SESSION['first_name'] = $user['first_name'];

    if (empty($user['password'])){
        redirect_to(url_for('index.php'));

    }

    
    redirect_to(url_for('login.php'));
  }

?>



<?php $page_title = 'Candidate'; ?>
<?php include(SHARED_PATH . '/candidate_header.php'); ?>

<!-- Page Content -->

<div id="content">
  <div class="row">
    <div class="col-lg-4 offset-lg-4">
      <div class="card h-100 text-center" id="regForm" style="margin: 0 auto;">
        <div class="card-header">
          <h1>Email Address</h1>
        </div>

        <div class="card-body">
        <form action="index.php" method="post">
          <input class="form-control" type="email" name="email" value="" /><br />
          <input type="submit" name="submit" value="Submit"  />
        </form>
        </div> <!-- End Card Body -->
      </div> <!-- End Card -->
    </div> <!-- End Col -->
  </div> <!-- End Row -->
</div>

<?php include(SHARED_PATH . '/candidate_footer.php'); ?>

<?php 

  if (isset($_SESSION['email']) && empty($user['password']) == 'true'){
  echo '<script type="text/JavaScript">setPassForm(); </script>'; 
  } ;
?> 

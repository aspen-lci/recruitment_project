<?php require_once('../private/initialize.php'); 

if(is_post_request()) {
    //assign email entered to a variable   !!! need to make all one case for comparison
    $email = $_POST['email'];
    
    //if post is from redirect to enter password, assign passwords to variables, otherwise make blank
    $submitted_password = $_POST['password'] ?? "";
    $confirm_password = $_POST['confirm_password'] ?? "";

    //Look up user in database and return user array
    $user = find_user_by_email($email);
    
    //if user returns empty, return error
    if (empty($user)){
        $_SESSION['message'] = "Email not found.  Please contact your recruiter.";
        redirect_to(url_for('index.php'));
    }
    
    //if user is populated, store values in session
    $_SESSION['email'] = $email;
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['password'] = $user['password'];

    // after SESSION values set, redirect to set password (controlled by js at end of html) else redirect to password entry
    redirect_to(url_for('index.php'));
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

  if (isset($_SESSION['email']) && !empty($_SESSION['password']) == 'true'){
    echo '<script type="text/JavaScript">enterPass(); </script>'; 
  }
?> 
</body>

</html>
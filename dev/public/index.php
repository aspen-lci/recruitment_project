<?php require_once('../private/initialize.php'); 

if(is_post_request()) {
    switch(true){
      case (isset($_SESSION['email']) && !empty($_SESSION['password']) === true):
        redirect_to(url_for('index.php'));
      break;

      case (isset($_SESSION['email']) && empty($_SESSION['password']) === true):
        //if post is from redirect to enter password, assign passwords to variables, otherwise make blank
        $submitted_password = $_POST['password'] ?? "";
        $confirm_password = $_POST['confirm_password'] ?? "";
        $result = set_password($submitted_password, $confirm_password, $_SESSION['email']);
        if ($result === true) {
          $_SESSION['password'] = password_hash($submitted_password, PASSWORD_BCRYPT);
          $_SESSION['message'] = "Password has been updated.  Please log in.";
          redirect_to(url_for('index.php'));
        }else {
          $errors = $result;
          $_SESSION['message'] = $errors;
        }
      break;

      default: 
        //assign email entered to a variable   !!! need to make all one case for comparison
        $email = $_POST['email'];
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
        $_SESSION['user_type'] = $user['type'];

        //check if password is blank
        // if(is_blank($_SESSION['password'])){
        //   echo '<script type="text/JavaScript">setPassForm(); </script>'; 
        // }else{
        //   echo '<script type="text/JavaScript">enterPass(); </script>';
        // break;
        // }

        redirect_to(url_for('index.php'));

    }  //end of switch
  } //end of if_post_request

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

  if (isset($_SESSION['email']) && is_blank($_SESSION['password'])){
  echo '<script type="text/JavaScript">setPassForm(); </script>'; 
  } ;

  if (isset($_SESSION['email']) && !empty($_SESSION['password'])){
    echo '<script type="text/JavaScript">enterPass(); </script>'; 
  }
?> 
</body>

</html>
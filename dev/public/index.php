<?php require_once('../private/initialize.php'); 

$errors = '';
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

        if($user['inactive'] == 0) {
         //if user is populated, store values in session
        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['user_type'] = $user['type'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['inactive'] = $user['inactive'];
        } else {
          $_SESSION['message'] = "Your account is not active.  Please contact your recruiter.";
        }

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
<?php include(SHARED_PATH . '/login_header.php'); ?>

<!-- Page Content -->

<div id="content">
  <div class="row">
    <div class="col-lg-6 offset-lg-3">
      <div class="card h-100" id="regForm">

        <div class="row no-gutters">

          <div class="col-sm-10">
            <div class="card-body">
              <h5 class="card-title" id="login-title">Log In</h5>
              <?php echo display_errors($errors); ?>
              <form id="login" action="<?php echo (!isset($_SESSION['password']) ? 'index.php' : 'login.php');?>" method="post">
                
                  <label for="email" class="control-label">Email</label>
                  <input class="form-control" type="email" name="email" value="<?php echo (isset($_SESSION['email']) ? $_SESSION['email'] : '');?>" <?php echo (isset($_SESSION['email']) ? 'disabled' : 'required');?> />

                <div style="display: <?php echo (isset($_SESSION['email']) ? 'initial' : 'none');?>;">
                
                  <label for="password">Password</label>
                  <input class="form-control" type="password" name="password" autocomplete="off" title="Passwords must be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol." <?php echo (isset($_SESSION['email']) ? 'required required pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){12,100}$" onchange="form.confirm_password.pattern = RegExp.escape(this.value);"' : '');?>/>
                </div>
                <div style="display: <?php echo (isset($_SESSION['email']) && is_blank($_SESSION['password']) ? 'initial' : 'none');?>;">
                  <label for="password">Confirm Password</label>
                  <input class="form-control" type="password" name="confirm_password" autocomplete="off" title="Passwords do not match." <?php echo (is_blank($_SESSION['password']) ? 'required' : '');?>/>

                  <p>Passwords must be at least 12 characters and include at least one uppercase letter, lowercase
                    letter, number, and symbol.</p>
                </div>
              

            </div>

          </div>
          <div class="col-sm-2" id="login-btn">
            <table id="login-table">
              <td>
                <button form="login" class="stretched-link" id="cust-btn" type="submit" name="submit">Sign In</button>
              </td>
            </table>
          </div>
          </form>
          </div>
          </div> <!-- End Card -->
        </div> <!-- End Col -->
      </div> <!-- End Row -->
    </div>

    <?php include(SHARED_PATH . '/candidate_footer.php'); ?>

   
    </body>

    </html>
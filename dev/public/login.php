<?php
require_once('../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $_SESSION['username'] = $username;

  redirect_to(url_for('/candidate/index.php'));
}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/candidate_header.php'); ?>

<div id="content">
  <div class="row">
    <div class="col-lg-4 offset-lg-4">
      <div class="card h-100 text-center" style="margin: 0 auto;">
        <div class="card-header">
          <h1>Log in</h1>
        </div>

        <div class="card-body">
        <?php echo display_errors($errors); ?>

        <form action="login.php" method="post">
          Email:<br />
          <input type="email" name="email" value="<?php echo (isset($_SESSION['email']) ? h($_SESSION['email']) : ""); ?>" /><br />
          Password:<br />
          <input type="password" name="password" value="" /><br />
          <input type="submit" name="submit" value="Submit"  />
        </form>
        </div> <!-- End Card Body -->
      </div> <!-- End Card -->
    </div> <!-- End Col -->
  </div> <!-- End Row -->
</div>

<?php include(SHARED_PATH . '/candidate_footer.php'); ?>
</body>

</html>
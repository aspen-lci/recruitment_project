<?php require_once('../../../private/initialize.php'); ?>

<?php
  
  if(is_post_request()){
    $id = $_GET['id'];
    $status = $_GET['inactive'];
    $result = change_user_status($id, $status);
   
    if($result===true){
      $_SESSION['message'] = "User status has been updated.";
    }else{
      $errors = $result;
      $_SESSION['message'] = "WARNING: User status has not been updated.";
    }
    redirect_to(url_for('/hr/hr_users/index.php'));
  }

  $user_set = all_users();
  $errors = '';
?>

<?php $page_title = 'Users'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<?php echo(display_errors($errors)); ?>

<div class="row text-center">
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-dark text-center">Users</h3>
                </div> <!-- Card header -->
                <div class="card-body"> 
                  <div class="actions text-left mb-2">
                    <a href="<?php echo url_for('/hr/hr_users/new.php') ?>">Create New User</a>
                  </div>
                <table
                data-toggle="table"
                data-sortable="true">
                <thead>
                  <tr>
                    <th style data-sortable="true" data-field="name">Name</th>
                    <th style data-sortable="true" data-field="email">Email</th>
                    <th style data-sortable="true" data-field="userType">User Type</th>
                    <th style data-sortable="true">Status</th>
                    <th style>Reset Password</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($user_set as $user) { ?>
                  <tr>
                    <td><a class="action" href="<?php echo url_for('/hr/hr_users/edit.php?id=' . h($user['user_id'])); ?>"><?php echo h($user['first_name']) . " " . h($user['last_name']); ?></a></td>
                    <td><?php echo h($user['email']); ?></td>
                    <td><?php echo h($user['role']); ?></td>
                    <td>
                        <div class="d-inline-block">
                          <p style="color: <?php echo($user['inactive'] == 1 ? "red" : "black"); ?>;"><?php echo($user['inactive'] == 1 ? "Inactive" : "Active"); ?></p>
                        </div>

                        <div class="d-inline-block">
                          <form  action="<?php echo url_for('/hr/hr_users/index.php?id=' . h(u($user['user_id'])) . '&inactive=' . $user['inactive']); ?>" method="post">
                            <button type="submit" class="btn btn-primary d-inline" value="submit">Change Status</button>
                          </form>
                        </div>
                    </td>

                    <td>
                      <form onsubmit="return confirm('<?php echo('Would you like to reset the password for ' . h($user['first_name']) . ' ' . h($user['last_name']) . '?'); ?>')" action="<?php echo url_for('/hr/hr_users/delete.php?id=' . h(u($user['user_id']))); ?>" method="post">
                        <button type="submit" class="btn btn-primary" value="submit">Reset Password</button>
                      </form>
                    </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>

              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->


<?php include(SHARED_PATH . '/hr_footer.php'); ?>  

</body>
</html>
<?php require_once('../../../private/initialize.php'); ?>

<?php
  $user_set = all_users();

?>

<?php $page_title = 'Users'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

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
                    <th style>Reset Password</th>
                    <th style>Inactive</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($user_set as $user) { ?>
                  <tr>
                    <td><a class="action" href="<?php echo url_for('/hr/hr_users/edit.php?id=' . h($user['user_id'])); ?>"><?php echo h($user['first_name']) . " " . h($user['last_name']); ?></a></td>
                    <td><?php echo h($user['email']); ?></td>
                    <td><?php echo h($user['role']); ?></td>
                    <td>
                      <form onsubmit="return confirm('Do you really want to submit the form?');" action="<?php echo url_for('/hr/hr_users/delete.php?id=' . h(u($user['id']))); ?>" method="post">
                        <button type="submit" class="btn btn-primary" value="submit">Reset Password</button>
                      </form>
                    </td>
                    <td>
                        <input type="checkbox" id="inactive" name="inactive" value="1" <?php echo($user['inactive'] === 1 ? "checked" : ""); ?>>
                        <label for="inactive">Make User Inactive</label>
                      <form  action="<?php echo url_for('/hr/hr_users/delete.php?id=' . h(u($user['id']))); ?>" method="post">
                        <button type="submit" class="btn btn-primary" value="submit">Change Status</button>
                      </form>
                        
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
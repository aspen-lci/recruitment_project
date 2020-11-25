<?php require_once('../../../private/initialize.php'); ?>

<?php
  
  if(is_post_request()){
    $id = $_GET['id'];
    $status = $_GET['inactive'];
    $role = $_GET['role'];
    $result = change_user_status($id, $status);
   
    if($result===true){
      $_SESSION['message'] = "User status has been updated.";
      if($role == '4' && $status == '1'){
        $disposition = make_candidate_active($id);
        if($disposition===true){
          $_SESSION['message'] .= " Candidate disposition is now Open.";
        }else{
          $errors = $disposition;
        }
      }
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
<a class="m-3 pl-4" href="<?php echo url_for('/hr/index.php'); ?>">&laquo; Return to Candidates In Process</a>
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h3 class="m-0 font-weight-bold text-dark text-center">Users</h3>
                </div> <!-- Card header -->
                <div class="card-body"> 
                <div class="d-flex">  
                    <button class="btn p-2" type="button" id="toggleInactive">Show Inactive Users</a>
                    <button class="btn p-2" type="button" id="allUsers">Show All Users</a>
                    <button class="btn ml-auto p-2" href="<?php echo url_for('/hr/hr_users/new.php') ?>">Create New User</button>
                  </div>
                </div>
                <table
                id="table"
                data-toggle="table"
                data-sortable="true"
                data-pagination="true" 
                data-search="true">
                <thead>
                  <tr>
                    <th style data-sortable="true" data-searchable="true" data-field="name">Name</th>
                    <th style data-sortable="true" data-searchable="true" data-field="email">Email</th>
                    <th style data-sortable="true" data-searchable="true" data-field="userType">User Type</th>
                    <th style data-sortable="true" data-searchable="true" data-field="status">Status</th>
                    <th style></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($user_set as $user) { ?>
                  <tr <?php echo($user['inactive'] == 0 ? '' : 'class="hidden"'); ?>>
                    <td><a class="action" href="<?php echo url_for('/hr/hr_users/edit.php?id=' . h($user['user_id'])); ?>"><?php echo h($user['first_name']) . " " . h($user['last_name']); ?></a></td>
                    <td><?php echo h($user['email']); ?></td>
                    <td><?php echo h($user['role']); ?></td>
                   

                    <td>
                    <div class="d-inline-block">
                          <p style="color: <?php echo($user['inactive'] == 1 ? "red" : "black"); ?>;"><?php echo($user['inactive'] == 1 ? "Inactive" : "Active"); ?></p>
                        </div>
                    </td>
                    <td>
                        <div class="dropdown d-inline-block">
                        <a type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                          <div class="dropdown-menu dropdown-primary">
                          <form  action="<?php echo url_for('/hr/hr_users/index.php?id=' . h(u($user['user_id'])) . '&inactive=' . $user['inactive'] . '&role=' . $user['role_id']); ?>" method="post">
                            <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Change Status</button>
                          </form>
                        
                      <form onsubmit="return confirm('<?php echo('Would you like to reset the password for ' . h($user['first_name']) . ' ' . h($user['last_name']) . '?'); ?>')" action="<?php echo url_for('/hr/hr_users/delete.php?id=' . h(u($user['user_id']))); ?>" method="post">
                        <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Reset Password</button>
                      </form>

                      

                      </div>
                      </div>
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

<script>
// $(function){
//   $('#table').bootstrapTable()
// })

// $('.tablemanager').tablemanager();

$(document).ready(function(){
  $("#toggleInactive").click(function(){
    $(this).text($(this).text() == 'Show Active Users' ? 'Show Inactive Users' : 'Show Active Users');
    $("tbody tr").toggleClass("hidden");
  });
});

$(document).ready(function(){
  $("#allUsers").click(function(){
    $('tbody tr').show();
  });
});
</script>

</body>
</html>
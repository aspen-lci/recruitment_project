<?php require_once('../../../private/initialize.php'); ?>

<?php
  $users = [
    ['id' => '1', 
    'userName' => 'aspencer', 
    'password' => '123password', 
    'firstName' => 'Angie', 
    'lastName' => 'Spencer', 
    'userType' => 'admin',
    'email' => 'angela.spencer@lastingchangeinc.org'],

    ['id' => '2', 
    'userName' => 'jfalk', 
    'password' => '123password', 
    'firstName' => 'Jenn', 
    'lastName' => 'Falk', 
    'userType' => 'hr',
    'email' => 'jenn.falk@lastingchangeinc.org'],

    ['id' => '3', 
    'userName' => 'jsmith', 
    'password' => '123password', 
    'firstName' => 'John', 
    'lastName' => 'Smith', 
    'userType' => 'candidate',
    'email' => 'johnsmith@gmail.com'],

    ['id' => '4', 
    'userName' => 'kpowell', 
    'password' => '123password', 
    'firstName' => 'Kristen', 
    'lastName' => 'Powell', 
    'userType' => 'recruiter',
    'email' => 'kristen.powell@lastingchangeinc.org']
  ]

?>

<?php $page_title = 'Users'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<div class="row text-center">
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Users</h6>
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
                    <th style data-sortable="true" data-field="userName">User Name</th>
                    <th style data-field="password">Password</th>
                    <th style data-sortable="true" data-field="full_name">Name</th>
                    <th style data-sortable="true" data-field="userType">User Type</th>
                    <th style data-sortable="true" data-field="email">Email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($users as $user) { ?>
                  <tr>
                    <td><a class="action" href="<?php echo url_for('/hr/hr_users/edit.php?id=' . h($user['id'])); ?>"><?php echo $user['userName']; ?></a></td>
                    <td><?php echo h($user['password']); ?></td>
                    <td><?php echo h($user['firstName']) . " " . h($user['lastName']); ?></td>
                    <td><?php echo h($user['userType']); ?></td>
                    <td><?php echo h($user['email']); ?></td>
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
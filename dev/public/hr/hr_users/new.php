<?php require_once('../../../private/initialize.php'); 

$type_set = all_user_types();

if(is_post_request()){
    $user = [];
    $user['first_name'] = $_POST['firstName'] ?? '';
    $user['last_name'] = $_POST['lastName'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['type'] = $_POST['userType'] ?? '';

    $result = insert_user($user);
   
    if($result === true) {
        $_SESSION['message'] = "User has been created";
        redirect_to(url_for('/hr/hr_users/index.php'));
    }else {
        $errors['user_exists'] = "User already exists.";
        
    }
}else {
    //display blank form
    $user = [];
    $user['first_name'] = '';
    $user['last_name'] = '';
    $user['email'] = '';
    $user['type'] = '';
}

?>

<?php $page_title = 'Create User'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<div id="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-dark text-center">Add New User</h3>
                </div>  <!-- Card Header End -->
                <div class="card-body">
                    <form action="<?php echo url_for('/hr/hr_users/new.php'); ?>" method="post">
                        <div class="form-row m-4">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php echo $user['first_name']; ?>" required>
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?php echo $user['last_name']; ?>" required>
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        <div class="form-row m-4">
                        <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" required>
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-6">
                                <label for="userType">User Type</label>
                                <select id="userType" class="form-control" name="userType" required>
                                    <option value="" selected>Choose User Type</option>
                                    <?php foreach ($type_set as $type) { ?>
                                        <option value="<?php echo $type['id'] ?>" <?php echo($user['type'] == $type['id'] ? 'selected' : '') ?>><?php echo $type['role'] ?></option>    
                                    <?php } ?>
                                </select>
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        
                        <div class="form-row m-4">
                            <div class="form-group col">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> <!-- Form Col End -->
                        </div><!-- Form Row End -->
                    </form>
                </div> <!-- Card Body End -->
            </div>  <!-- Card End -->
        </div>  <!-- Col End -->
    </div>  <!-- Row End -->

</div> <!-- Content End -->


<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
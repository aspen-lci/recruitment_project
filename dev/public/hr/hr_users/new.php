<?php require_once('../../../private/initialize.php'); 

$type_set = all_user_types();
$ll_position_set = all_active_positions(2);
$cw_position_set = all_active_positions(3);
$company_set = all_companies();

if(is_post_request()){
    $user = [];
    $user['first_name'] = $_POST['firstName'] ?? '';
    $user['last_name'] = $_POST['lastName'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['type'] = $_POST['userType'] ?? '';
    $position = $_POST['position'] ?? '';

    $result = insert_user($user);
   
    if($result === true) {
        
        if($user['type'] == '6'){
            $id = find_user_id_by_email($_POST['email']);
            
            $user_id = $id[0][id];
            $result2 = insert_manager($user['email'], $position);
                if($result2 === true){
                $_SESSION['message'] = "User has been created";
                redirect_to(url_for('/hr/hr_users/index.php'));
                }else{
                    $errors['manager'] = "Manager could not be created.";
                }
                
            }else{
                $_SESSION['message'] = "User has been created";
                // redirect_to(url_for('/hr/hr_users/index.php'));
            }
        }else {
        $errors['user_exists'] = "User already exists." . $result;
        
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
                                <div id="mgr_opt" class="form-row hidden">
                                <div id="companies" class="form-group col-md-6">
                                    <label class="mt-2" for="company">Company</label>
                                    <select id="company" class="form-control" name="company" required>
                                        <option value="" selected>Choose Company</option>
                                        <?php foreach ($company_set as $company) { ?>
                                        <option value="<?php echo $company['id'] ?>" ><?php echo $company['company'] ?></option>    
                                    <?php } ?>
                                    </select> 
                                    </div> <!-- positions end -->
                                    <div id="positions" class="form-group col-md-6">
                                    <label class="mt-2" for="position">Managed Position</label>
                                    <select id="position" class="form-control" name="position" required>
                                        <option value="" selected>Choose Position</option>
                                        <?php foreach ($positions as $position) { ?>
                                            <option value="<?php echo $position['id'] ?>" <?php echo $position['title'] ?></option>    
                                        <?php } ?>
                                    </select>
                                    </div> <!-- positions end -->
                                </div> <!-- Nested Row End -->
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

<script>
    $(document).ready(function(){
       $("#userType").change(function(){
            var user = $(this);
            if(user.val() === '6'){
                $('#mgr_opt').removeClass('hidden');

                $("#company").change(function(){
                    var c = $(this);
                    var ll = '<select id="position" class="form-control" type="select" name="position"><?php foreach ($ll_position_set as $position) { ?><option value="<?php echo $position['id']; ?>" ><?php echo $position['title'] ?></option><?php } ?>';
                    var cw = '<select id="position" class="form-control" type="select" name="position"><?php foreach ($cw_position_set as $position) { ?><option value="<?php echo $position['id'];?>"><?php echo $position['title'] ?></option><?php } ?>';
                    
                    if(c.val() === '2'){
                        $("#position").replaceWith(ll);
                        
                    }
                    else if(c.val() === '3'){
                        $("#position").replaceWith(cw);
                        
                    }
                });
        };
    });
});
</script>

</body>
</html>
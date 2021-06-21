<?php require_once('../../../private/initialize.php'); 

if(!isset($_GET['id'])){
    redirect_to(url_for('hr/hr_users/index.php'));
}
$id = $_GET['id'];
$user = find_user_by_id($id);
$type_set = all_user_types();
$ll_position_set = all_active_positions(2);
$cw_position_set = all_active_positions(3);
$position_set = all_positions();
$company_set = all_companies();

$user['position_id'] = '';
$user['company_id'] = '';

if($user['role_id'] == 6){
    $manager = find_manager_by_id($id);
   
    $user['position_id'] = $manager['position_id'];
    $user['company_id'] = $manager['company_id'];
}

if(is_post_request()){
    $update_user['id'] = $id;
    $update_user['first_name'] = $_POST['first_name'];
    $update_user['last_name'] = $_POST['last_name'];
    $update_user['type'] = $_POST['userType'];
    $update_user['email'] = $_POST['email'];
    $update_user['company_id'] = $_POST['company'] ?? '';
    $update_user['position_id'] = $_POST['position'] ?? '';
 
    if($update_user['type'] == '6'){
        $result = update_manager($update_user);
    }else{
        $result = update_user($update_user);
       
    }

    if($result === true) {
        $_SESSION['message'] = "User has been updated";
       redirect_to(url_for('/hr/hr_users/index.php'));
    }else {
        $errors['user_error'] = $result;
        
    }

}
$page_title = 'Edit User';
include(SHARED_PATH . '/hr_header.php');

?>

<div id="content">

    <div class="row">
        
            <a class="m-3 pl-4" href="<?php echo url_for('/hr/hr_users/index.php'); ?>" onclick="return confirm('Any changes made will not be saved.')">&laquo; Return to List</a>
        
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-dark text-center">Edit User</h4>
                </div>  <!-- Card Header End -->
                <div class="card-body">
                    <form action="<?php echo url_for('/hr/hr_users/edit.php?id=' . h(u($id))); ?>" method="post">
                        <div class="form-row m-4">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="<?php echo $user['first_name']; ?>">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="<?php echo $user['last_name']; ?>">
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                       
                        <div class="form-row m-4">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-6">
                                <label for="userType">User Type</label>
                                <select id="userType" class="form-control" name="userType">
                                <?php foreach ($type_set as $type) { ?>
                                        <option value="<?php echo $type['id'] ?>" <?php echo($type['id'] == $user['role_id'] ? "selected" : ""); ?>><?php echo $type['role'] ?></option>    
                                    <?php } ?>
                                </select>
                                <div id="mgr_opt" class="form-row <?php echo($user['role_id'] == 6 ? '' : 'hidden'); ?>">
                                <div id="companies" class="form-group col-md-6">
                                    <label class="mt-2" for="company">Company</label>
                                    <select id="company" class="form-control" name="company">
                                        <option value="" selected>Choose Company</option>
                                        <?php foreach ($company_set as $company) { ?>
                                        <option value="<?php echo $company['id'] ?>" <?php echo($company['id'] == $user['company_id'] ? 'selected' : ''); ?>><?php echo $company['company'] ?></option>    
                                    <?php } ?>
                                    </select> 
                                    </div> <!-- positions end -->
                                    <div id="positions" class="form-group col-md-6">
                                    <label class="mt-2" for="position">Managed Position</label>
                                    <select id="position" class="form-control" name="position">
                                        <?php foreach ($position_set as $position) { ?><option value="" <?php echo($user['position_id'] == '' ?? selected); ?>>Choose Position</option><option value="<?php echo $position['id']; ?>" <?php echo($position['id'] == $user['position_id'] ? 'selected' : ''); ?>><?php echo $position['title'] ?></option><?php } ?>
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

                
        }else{
            $('#mgr_opt').addClass('hidden');
        };
    });
    $("#company").change(function(){
                    var c = $(this);
                    var ll = '<select id="position" class="form-control" type="select" name="position"><?php foreach ($ll_position_set as $position) { ?><option value="<?php echo $position['id']; ?>"><?php echo $position['title'] ?></option><?php } ?> ';
                    var cw = '<select id="position" class="form-control" type="select" name="position"><?php foreach ($cw_position_set as $position) { ?><option value="<?php echo $position['id'];?>"><?php echo $position['title'] ?></option><?php } ?> ';
                    
                    if(c.val() === '2'){
                        $("#position").replaceWith(ll);
                        
                    }
                    else if(c.val() === '3'){
                        $("#position").replaceWith(cw);
                        
                    }
                });
});
</script>
</body>
</html>
<?php require_once('../../../private/initialize.php'); 

if(!isset($_GET['id'])){
    redirect_to(url_for('hr/hr_users/index.php'));
}
$id = $_GET['id'];
$userName = '';
$password = '';
$firstName = '';
$lastName = '';
$userType = '';
$email = '';

if(is_post_request()){
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userType = $_POST['userType'];
    $email = $_POST['email'];
 
    echo "Form parameters<br />";
    echo "User name: " . $userName . "<br />";
    echo "Password: " . $password . "<br />";
    echo "First name: " . $firstName . "<br />";
    echo "Last name: " . $lastName . "<br />";
    echo "User type: " . $userType . "<br />";
    echo "Email: " . $email . "<br />";
}
$page_title = 'Edit User';
include(SHARED_PATH . '/hr_header.php');

?>

<div id="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Edit User</h3>
                </div>  <!-- Card Header End -->
                <div class="card=body">
                    <form action="<?php echo url_for('/hr/hr_users/edit.php?id=' . h(u($id))); ?>" method="post">
                        <div class="form-row m-4">
                            <div class="form-group col-md-6">
                                <label for="userName">User Name</label>
                                <input type="text" class="form-control" name="userName" value="<?php echo $userName; ?>" placeholder="User Name">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>"placeholder="Password">
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        <div class="form-row m-4">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" name="firstName" value="<?php echo $firstName; ?>"placeholder="First Name">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lastName" value="<?php echo $lastName; ?>" placeholder="Last Name">
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        <div class="form-row m-4">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-6">
                                <label for="userType">User Type</label>
                                <select id="userType" class="form-control" name="userType" value="<?php echo $userType; ?>">
                                    <option selected>Choose User Type</option>
                                    <option value="Admin">Admin</option>
                                    <option value="HR">HR</option>
                                    <option value="Candidate">Candidate</option>
                                    <option value="Recruiter">Recruiter</option>
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
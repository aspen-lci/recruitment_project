<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Create User'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<div id="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Add New User</h3>
                </div>  <!-- Card Header End -->
                <div class="card=body">
                    <form action="<?php echo url_for('/hr/hr_candidates/new.php'); ?>" method="post">
                        <div class="form-row m-4">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" name="firstName" placeholder="First Name">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lastName" placeholder="Last Name">
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        <div class="form-row m-4">
                        <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        
                        <div class="form-row m-4">
                            <div class="form-group col-md-6">
                                <label for="userType">User Type</label>
                                <select id="userType" class="form-control" name="userType">
                                    <option selected>Choose User Type</option>
                                    <option value="Admin">Admin</option>
                                    <option value="HR">HR</option>
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
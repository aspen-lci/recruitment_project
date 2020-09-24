<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Create Candidate'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<div id="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Add New Candidate</h3>
                </div>  <!-- Card Header End -->
                <div class="card=body">
                    <form action="<?php echo url_for('/hr/hr_candidates/create.php'); ?>" method="post">
                        <div class="form-row m-4">
                            <div class="form-group col-md-4">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" name="firstName" placeholder="First Name">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-4">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lastName" placeholder="Last Name">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        <div class="form-row m-4">
                            <div class="form-group col-md-4">
                                    <label for="company">Company</label>
                                    <select id="company" class="form-control" name="company">
                                        <option selected>Choose Company</option>
                                        <option value="Lifeline">Lifeline</option>
                                        <option value="Crosswinds">Crosswinds</option>
                                        <option value="Lasting Change">Lasting Change</option>
                                    </select>
                            </div> <!-- Form Col End -->
                            
                            <div class="form-group col-md-4">
                                    <label for="position">Position</label>
                                    <select id="position" class="form-control" name="position">
                                        <option selected>Choose Position</option>
                                        <option value="therapist">Therapist</option>
                                        <option value="fccm">Family Consultant/Case Manager</option>
                                        <option value="visitation">Visitation Specialist</option>
                                        <option value="homemaker">Homemaker/Parent Aide</option>
                                    </select>
                            </div> <!-- Form Col End -->

                            <div class="form-group col-md-4">
                                <label for="date">Start Date</label>
                                <input type="date" class="form-control" name="startDate" placeholder="Start Date">
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        
                        <div class="form-row m-4">
                            
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
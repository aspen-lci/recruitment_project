<?php require_once('../../../private/initialize.php'); 

$company_set = all_companies();
$position_set = all_positions();
$region_set = all_regions();
$recruiter_set = all_recruiters();
$ii_dates = all_ii_dates();

if(is_post_request()){
    $position_explode = explode('|', $_POST['position']);
    $position = $position_explode[0];
    $jd_doc_id = $position_explode[1];

    $candidate = [];
    $candidate['first_name'] = $_POST['firstName'] ?? '';
    $candidate['last_name'] = $_POST['lastName'] ?? '';
    $candidate['email'] = $_POST['email'] ?? '';
    $candidate['type'] = 4;
    $candidate['recruiter'] = $_POST['recruiter'] ?? '';
    $candidate['company'] = $_POST['company'] ?? '';
    $candidate['position'] = $position ?? '';
    $candidate['jd_doc_id'] = $jd_doc_id ?? '';
    $candidate['region'] = $_POST['region'] ?? 'NULL';
    $candidate['start_date'] = $_POST['startDate'] ?? '';
    $candidate['interview_date'] = $_POST['interviewDate'] ?? '';
    $candidate['interview_time'] = $_POST['interviewTime'] ?? '';
    $candidate['ii_date'] = $_POST['iiDate'] ?? '';

    $result = insert_candidate($candidate);

    if($result === true){
        $_SESSION['message'] = "Candidate has been created.";
        redirect_to(url_for('/hr/index.php'));
    }else{
        $errors = $result;
    }
}

?>

<?php $page_title = 'Create Candidate'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<div id="content">
    <?php echo(!empty($errors) ? display_errors($errors) : ""); ?>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-dark text-center">Add New Candidate</h3>
                </div>  <!-- Card Header End -->
                <div class="card=body">
                    <form action="<?php echo url_for('/hr/hr_candidates/new.php'); ?>" method="post">
                        <div class="form-row m-4">
                            <div class="form-group col-md-3">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" name="firstName">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-3">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lastName">
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div> <!-- Form Col End -->

                            <div class="form-group col-md-3">
                                    <label for="recruiter">Assigned Recruiter</label>
                                    <select id="recruiter" class="form-control" name="recruiter">
                                        <!-- <option selected>Choose Recruiter</option> -->
                                        <?php foreach ($recruiter_set as $recruiter) { ?>
                                        <option value="<?php echo $recruiter['recruiter_id'] ?>" <?php echo($recruiter['email'] === $_SESSION['email'] ? 'selected' : ''); ?>><?php echo ($recruiter['first_name'] . ' ' . $recruiter['last_name']); ?></option>    
                                    <?php } ?>
                                    </select>
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        <div class="form-row m-4">
                            <div class="form-group col-md-4">
                                    <label for="company">Company</label>
                                    <select id="company" class="form-control" name="company">
                                        <!-- <option selected>Choose Company</option> -->
                                        <?php foreach ($company_set as $company) { ?>
                                        <option value="<?php echo $company['id'] ?>" <?php echo($company['id'] === '2' ? 'selected' : 'disabled'); ?>><?php echo $company['company'] ?></option>    
                                    <?php } ?>
                                    </select>
                            </div> <!-- Form Col End -->
                            
                            <div class="form-group col-md-4">
                                    <label for="position">Position</label>
                                    <select id="position" class="form-control" name="position">
                                        <option value = "" selected>Choose Position</option>
                                        <?php foreach ($position_set as $position) { ?>
                                        <option value="<?php echo $position['id'] . '|' . $position['jd_doc_id']?>"><?php echo $position['title'] ?></option>    
                                    <?php } ?>
                                    </select>
                            </div> <!-- Form Col End -->

                            <div class="form-group col-md-4" id="nsRadio">
                                    <p>District for Panel Interview Zoom Link</p>
                                    <?php foreach ($region_set as $region) { ?>
                                        <label for="region"><input type="radio" name="region" value="<?php echo $region['id'] ?>" required><?php echo $region['name'] ?></label>    
                                    <?php } ?>
                            </div> <!-- Form Col End -->

                            
                        </div> <!-- Form Row End -->
                        
                        <div class="form-row m-4">
                            
                            <div class="form-group col-md-4">
                                <label for="interviewDate">Panel Interview Date</label>
                                <input type="date" class="form-control" id="interviewDate" name="interviewDate" >
                                <label class="pt-2" for="interviewTime">Panel Interview Time</label>
                                <input type="time" class="form-control" name="interviewTime" >
                            </div> <!-- Form Col End -->

                            <div class="form-group col-md-4">
                                <label for="date">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date">
                            </div> <!-- Form Col End -->

                            <div class="form-group col-md-4">
                                <label for="iiDate">Impact Institute Date</label>
                                <br>
                                <select class="form-control" id="iiDate" type="select" name="iiDate">
                                <option value="">Select a Date</option>
                                    <?php foreach($ii_dates as $date) echo('<option value=' . $date['date'] . '>' . sprintf('%s</option>' . PHP_EOL, (new DateTime($date['date']))->format("m/d/Y"))); ?>
                                </select>
                               
                            </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="form-row m-4">
                            <div class="form-group col">
                                <button type="submit" class="btn">Submit</button>
                            </div> <!-- Form Col End -->
                        </div><!-- Form Row End -->
                    </form>
                </div> <!-- Card Body End -->
            </div>  <!-- Card End -->
        </div>  <!-- Col End -->
    </div>  <!-- Row End -->

</div> <!-- Content End -->
<script>
   (function() {
      var elem = document.createElement('input');
      elem.setAttribute('type', 'date');
 
      if ( elem.type === 'text' ) {
         $('#iiDate').datepicker();
         $('#startDate').datepicker();
         $('#interviewDate').datepicker();
      }
   })();

 

 
</script>

<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
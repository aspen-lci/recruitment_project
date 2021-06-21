<?php require_once('../../../private/initialize.php'); 

$company_set = all_companies();
$ll_position_set = all_active_positions(2);
$cw_position_set = all_active_positions(3);
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
    $candidate['intern'] = $_POST['intern'] ?? '';
    $candidate['jd_doc_id'] = $jd_doc_id ?? '';
    $candidate['region'] = $_POST['region'] ?? 'NULL';
    $candidate['start_date'] = $_POST['startDate'] ?? '';
    $candidate['interview_date'] = $_POST['interviewDate'] ?? '';
    $candidate['interview_time'] = $_POST['interviewTime'] ?? '';
    $candidate['ii_date'] = $_POST['iiDate'] ?? '';

    $exists = find_user_by_email($candidate['email']);

    if(!$exists){

    $result = insert_candidate($candidate);

    if($result === true){
        $_SESSION['message'] = "Candidate has been created.";
        redirect_to(url_for('/hr/index.php'));
    }else{
        $errors = $result;
    }
} else{
    $errors['user_exists'] = "Candidate already exists.  Please contact Jenn Falk for further information.";
}
}

?>

<?php $page_title = 'Create Candidate'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<div id="content">
    <?php echo(!empty($errors) ? display_errors($errors) : ""); ?>
    
    <div class="row">
    <a class="m-3 pl-4" href="<?php echo url_for('/hr/index.php'); ?>">&laquo; Return to Candidates In Process</a>
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
                                <input type="text" class="form-control" name="firstName" required>
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-3">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lastName" required>
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div> <!-- Form Col End -->
                            <div class="form-group col-md-3">
                                    <label for="recruiter">Assigned Recruiter</label>
                                    <select id="recruiter" class="form-control" name="recruiter" required>
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
                                        <option value="" selected>Choose Company</option>
                                        <?php foreach ($company_set as $company) { ?>
                                        <option value="<?php echo $company['id'] ?>" ?><?php echo $company['company'] ?></option>    
                                    <?php } ?>
                                    </select>
                            </div> <!-- Form Col End -->
                            
                            <div class="form-group col-md-4">
                                    <label for="position">Position</label>
                                    <select id="position" class="form-control" name="position" required>
                                        <option value = "" selected>Choose Position</option>
                                        
                                    </select>
                            </div> <!-- Form Col End -->

                            <div class="form-group col-md-1">
                                    <label class="ml-2" for="intern">Intern</label>
                                    <input type="checkbox" id="intern" class="form-control" name="intern" value=1>
                                        
                            </div> <!-- Form Col End -->

                            <div class="form-group col-md-3">
                                    <label for="region">Panel Interview Region</label>
                                    <select id="region" class="form-control" name="region" required>
                                        <option value="" selected>Choose Region</option>
                                        
                                    </select>
                            </div> <!-- Form Col End -->

                            
                        </div> <!-- Form Row End -->
                        
                        <div class="form-row m-4">
                            
                            <div class="form-group col-md-4">
                                <label for="interviewDate">Panel Interview Date</label>
                                <input type="date" class="form-control" id="interviewDate" name="interviewDate">
                            </div> <!-- Form Col End -->

                            <div class="form-group col-md-4">
                                <label for="interviewTime">Panel Interview Time</label>
                                <input type="time" class="form-control" name="interviewTime">
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

   $(document).ready(function(){
        $("#company").change(function(){
            var c = $(this);
            var ll = '<select id="position" class="form-control" name="position" required><option value = "" selected>Choose Position</option><?php foreach ($ll_position_set as $position) { ?><option value="<?php echo $position['id'] . '|' . $position['jd_doc_id']?>"><?php echo $position['title'] ?></option><?php } ?>';
            var cw = '<select id="position" class="form-control" name="position" required><option value = "" selected>Choose Position</option><?php foreach ($cw_position_set as $position) { ?><option value="<?php echo $position['id'] . '|' . $position['jd_doc_id']?>"><?php echo $position['title'] ?></option><?php } ?>';
            var ll_reg = '<select id="region" class="form-control" name="region" required><option value = "" selected>Choose Region</option><?php foreach ($region_set as $region) { ?><option value="<?php echo $region['id'] ?>" <?php echo($region['id'] == '24' ? 'style="display:none;"' : '') ?>><?php echo $region['name'] ?></option><?php } ?></select>';
            var cw_reg = '<select id="region" class="form-control" name="region" required><option value = "24" selected>Crosswinds</option></select>';
            if(c.val() === '2'){
                $("#position").replaceWith(ll);
                $("#region").replaceWith(ll_reg);
            }
            else if(c.val() === '3'){
                $("#position").replaceWith(cw);
                $("#region").replaceWith(cw_reg);
            }
        });
  
   });

   $(document).ready(function(){
    $("#position").change(function(){
            var p = $(this);
            var yts_reg = '<select id="region" class="form-control" name="region" required><option value = "" selected></option>Choose Region<option value = "25">PWA</option><option value = "26">Spencer Home</option></select>';
            if(p.val() === '3|2'){
                $("#region").replaceWith(yts_reg);
            }
   
        });
  
   });

 
</script>

<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
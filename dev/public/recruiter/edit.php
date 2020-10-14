<?php require_once('../../private/initialize.php'); 
    require_login();

    $company_set = all_companies();
    $position_set = all_positions();
    $region_set = all_regions();
    $recruiter_set = all_recruiters();

    if(!isset($_GET['id'])){
        redirect_to(url_for('/recruiter/index.php'));
    }

    $id = $_GET['id'];

    $candidate_list = get_candidate_by_id($id);
    $candidate = $candidate_list[0];

    $document_list = documents_by_candidate($id);

    if(is_post_request()){
        $update = [];
        $update['candidate_id'] = $id;
        $update['first_name'] = $_POST['first_name'];
        $update['last_name'] = $_POST['last_name'];
        $update['email'] = $_POST['email'];
        $update['recruiter'] = $_POST['recruiter'];
        $update['company'] = $_POST['company'];
        $update['position'] = $_POST['position'];
        $update['interview_date'] = $_POST['interviewDate'];
        $update['interview_time'] = $_POST['interviewTime'];
        $update['start_date'] = $_POST['startDate'];
        $update['ii_date'] = $_POST['iiDate'];
        print_r($update);

    }

?>

<?php $page_title = 'View Candidate'; ?>
<?php include(SHARED_PATH . '/recruiter_header.php'); ?>

<div id="content">
<a href="<?php echo url_for('/recruiter/index.php'); ?>">&laquo; Return to List</a>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <form id="edit-form" form="edit-form" action="<?php echo url_for('/recruiter/edit.php?id=' . $candidate['candidate_id']); ?>" method="post">
                   
                <div class="card-header py-3 d-flex justify-content-center" id="candidate_chead">
                    <div id="name-div">
                        <input class="m-0 font-weight-bold text-center" type="text" id="name" name="first_name" value="<?php echo h($candidate['first_name']); ?>"/>
                        <input class="m-0 font-weight-bold text-center" type="text" id="last_name" name="last_name" value="<?php echo h($candidate['last_name']); ?>"/>
                    </div>
                    <div id="edit-form-btn" style="float:right;">
                        <button form="edit-form" type="submit" class="btn">Update</button>
                        <button form="edit-form" type="reset" value="Cancel" class="btn btn-info" id="cancel">Cancel</button>
                    </div>
                </div>  <!-- Card Header End -->
                <div class="card=body">
                    <div class="row m-4">
                        <div class="col-3">
                            <label>Email: </label><input id="email" type="text" name="email" value="<?php echo($candidate['email']); ?>"/>
                            <br>
                            <label>Recruiter:</label>
                            <select id="recruiter" type="select" name="recruiter" value="<?php echo($candidate['recruiter']); ?>">
                                <?php foreach ($recruiter_set as $recruiter) { ?>
                                        <option value="<?php echo $recruiter['id'] ?>" <?php echo($recruiter['recruiter_id'] === $candidate['recruiter_id'] ? 'selected' : ''); ?>><?php echo ($recruiter['first_name'] . " " . $recruiter['last_name']); ?></option>    
                                    <?php } ?>
                            </select>
                            
                            <p>Disposition: <?php echo($candidate['disposition']); ?></p>
                            
                        </div> <!-- Form Col End -->

                        <div class="col-3">
                            <label>Company:</label> 
                            <select id="company" type="select" name="company" value="<?php echo($candidate['company']); ?>">
                            <?php foreach ($company_set as $company) { ?>
                                        <option value="<?php echo $company['id'] ?>" <?php echo($company['company'] === $candidate['company'] ? 'selected' : ''); ?>><?php echo $company['company'] ?></option>    
                                    <?php } ?>
                            </select> <br/>
                            <label>Position:</label> 
                            <select id="position" type="select" name="position" value="<?php echo($candidate['position']); ?>">
                            <?php foreach ($position_set as $position) { ?>
                                        <option value="<?php echo $position['id'];?>" <?php echo($position['title'] === $candidate['position'] ? 'selected' : ''); ?>><?php echo $position['title'] ?></option>    
                                    <?php } ?>
                            </select>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <label>Interview Date:</label> <input id="interviewDate" type="date" name="interviewDate" value="<?php echo(h($candidate['interview_date'])); ?>"/>
                            <label>Interview Time:</label> <input id="interviewTime" type="time" name="interviewTime" value="<?php echo(h($candidate['interview_time'])); ?>"/>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <label>Start Date:</label> <input id="startDate" type="date" name="startDate" value="<?php echo($candidate['start_date']); ?>"/>
                            <label>Impact Institute Date:</label> <input id="iiDate" type="date" name="iiDate" value="<?php echo($candidate['ii_date']); ?>"/>
                        </div> <!-- Form Col End -->
                        <div class="form-row m-4">
                            
                        </div><!-- Form Row End -->    
                    </form>
                    </div> <!-- Form Row End -->
                        
                    <div class="row m-4">

                        <h3>Documents</h3>
                    </div> <!-- Form Row End -->
                    <div class="row m-4 doc_status">
                        <div class="col-md-4">
                            <h5>Job Description: </h5>
                            <p><?php echo(get_job_desc($document_list)); ?></p>
                        </div> <!-- Form Col End -->
                    
                        <div class="col-md-4">
                            <h5>Disclosure: </h5>
                            <p><?php echo(document_in_document_list($document_list, '4')); ?></p>
                        </div> <!-- Form Col End -->
                        
                        
                        <div class="col-md-4">
                            <h5>LEA Background Check: </h5>
                            <p><?php echo(document_in_document_list($document_list, '5')); ?></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4 doc_status">
                        <div class="col-md-4">
                            <h5>Lifeline Background Check:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '6')); ?></p>
                        </div> <!-- Form Col End -->
                        
                        <div class="col-md-4">
                            <h5>Job Offer:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '7')); ?></p>
                        </div> <!-- Form Col End -->
                        
                        <div class="col-md-4">
                            <h5>Transcripts:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '8')); ?></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4 doc_status">
                        <div class="col-md-4">
                            <h5>Fingerprinting:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '9')); ?></p>
                        </div> <!-- Form Col End -->
                        
                        <div class="col-md-4">
                            <h5>Reference Check:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '10')); ?></p>
                        </div> <!-- Form Col End -->
                        
                        <div class="col-md-4">
                            <h5>UltiPro Onboarding:</h5>
                            <p><?php echo(document_in_document_list($document_list, '11')); ?></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                   
                </div> <!-- Card Body End -->
            </div>  <!-- Card End -->
        </div>  <!-- Col End -->
    </div>  <!-- Row End -->

</div> <!-- Content End -->


<?php include(SHARED_PATH . '/hr_footer.php'); ?>  

<script>
function resizeInput() {
    $(this).attr('size', $(this).val().length);
}

$('input[type="text"]')
    // event handler
    .keyup(resizeInput)
    // resize on page load
    .each(resizeInput);


    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.buttons =
    '<button type="submit" class="btn btn-primary btn-sm editable-submit">' +
        '<i class="fa fa-fw fa-check"></i>' +
        '</button>' +
    '<button type="button" class="btn btn-warning btn-sm editable-cancel">' +
        '<i class="fa fa-fw fa-times"></i>' +
        '</button>';
   
        $(document).ready(function(){
        $('#name').editable();

        $('#last_name').editable();

        $('#email').editable();

       
        });

        
</script>
</body>
</html>
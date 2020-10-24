<?php require_once('../../private/initialize.php'); 
    require_login();

    $company_set = all_companies();
    $position_set = all_positions();
    $region_set = all_regions();
    $recruiter_set = all_recruiters();
    $ii_dates = all_ii_dates();

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
        $update['user_id'] = $candidate['user_id'];
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
        

        $result = edit_candidate_recruiter($update);
        if ($result === true) {
            $_SESSION['message'] = "User has been updated.";
            redirect_to(url_for('/recruiter/index.php'));
        }else{
            print_r($update);
            $errors=$result;
        }
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
                                        <option value="<?php echo $recruiter['recruiter_id'] ?>" <?php echo($recruiter['recruiter_id'] === $candidate['recruiter_id'] ? 'selected' : ''); ?>><?php echo ($recruiter['first_name'] . " " . $recruiter['last_name']); ?></option>    
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
                            </select><br/>
                            <label>Region:</label> 
                            <select id="region" type="select" name="region" value="<?php echo($candidate['region']); ?>">
                            <?php foreach ($region_set as $region) { ?>
                                        <option value="<?php echo $region['id'];?>" <?php echo($region['id'] === $candidate['region_id'] ? 'selected' : ''); ?>><?php echo $region['name'] ?></option>    
                                    <?php } ?>
                            </select>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <label>Interview Date:</label> <input id="interviewDate" type="date" name="interviewDate" value="<?php echo(h($candidate['interview_date'])); ?>"/>
                            <label>Interview Time:</label> <input id="interviewTime" type="time" name="interviewTime" value="<?php echo(h($candidate['interview_time'])); ?>"/>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <label>Start Date:</label> <input id="startDate" type="date" name="startDate" value="<?php echo($candidate['start_date']); ?>"/>
                            <label>Impact Institute Date:</label> 
                            <select id="iiDate" type="select" name="iiDate">
                            <option value="" <?php echo(is_blank($candidate['ii_date']) ? 'selected' : ''); ?>></option>
                            <?php foreach ($ii_dates as $date) { ?>
                                <option value="<?php echo $date['date']; ?>" <?php echo($date['date'] === $candidate['ii_date'] ? 'selected' : ''); ?>><?php echo $date['date']; ?></option>
                            <?php } ?>
                            </select>
                        </div> <!-- Form Col End -->
                        
                    </form>
                    </div> <!-- Form Row End -->
                        
                    <div class="row m-4 d-flex align-items-center justify-content-center">
                        
                            <h3>Documents</h3>
                        
                            </div>
                    <div class="row m-4 justify-content-center">
                        <div class="card-deck mb-3 text-center">
                        <div class="card">
                            <div class="card-header c-card-1 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">Job Description</p>
                            </div> <!--End Card Header -->

                            <div class="card-body flex-column h-100">
                                <p class="card-text"><?php echo(get_job_desc($document_list)); ?></p>
                            </div> <!-- End Card body -->
                            </div> <!-- End Card -->
                        
                        <div class="card">
                            <div class="card-header c-card-2 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">Disclosure</p>
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p class="card-text"><?php echo(document_in_document_list($document_list, '4')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        
                        <div class="card">
                            <div class="card-header c-card-3 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">LEA</p>
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '5')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                    
                        <div class="card">
                            <div class="card-header c-card-4 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">Background Check</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '6')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->

                        <div class="card">
                            <div class="card-header c-card-5 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">Panel Interview</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '13')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        </div> <!-- End Card Group -->
                </div> <!-- End Row -->
                        
                        
                        <div class="row d-flex justify-content-center m-0"> <!-- m-4 justify-content-center"> -->
                        <div class="card-deck mb-3 text-center"> <!-- mb-3 text-center" -->
                        <div class="card">
                            <div class="card-header c-card-5 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">Job Offer</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '7')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                    <!-- </div>
                        <div class="card-deck mb-3 text-center"> -->
                        <div class="card">
                            <div class="card-header c-card-6 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">Transcripts</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '8')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->

                        <div class="card">
                            <div class="card-header c-card-7 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">Fingerprinting</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '9')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        
                        <div class="card">
                            <div class="card-header c-card-8 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">Reference Check</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '10')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        
                        <div class="card">
                            <div class="card-header c-card-9 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">UltiPro Onboarding</p>
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '11')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                   </div> <!-- End Card Group -->
                </div> <!-- End Row -->
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

// $('input[type="text"]')
//     // event handler
//     .keyup(resizeInput)
//     // resize on page load
//     .each(resizeInput);


//     $.fn.editable.defaults.mode = 'inline';
//     $.fn.editableform.buttons =
//     '<button type="submit" class="btn btn-primary btn-sm editable-submit">' +
//         '<i class="fa fa-fw fa-check"></i>' +
//         '</button>' +
//     '<button type="button" class="btn btn-warning btn-sm editable-cancel">' +
//         '<i class="fa fa-fw fa-times"></i>' +
//         '</button>';
   
//         $(document).ready(function(){
//         $('#name').editable();

//         $('#last_name').editable();

//         $('#email').editable();

       
//         });

        
</script>
</body>
</html>
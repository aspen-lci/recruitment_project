<?php require_once('../../private/initialize.php'); 
    require_login();
    
    $company_set = all_companies();
    $ll_position_set = all_active_positions(2);
    $cw_position_set = all_active_positions(3);
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
    $notes = get_notes_by_candidate_id($id);

    if(!$notes){
        $candidate['notes'] = '';    
    }else{
    $candidate['notes'] = $notes[0]['note_text'];
    }

    if(is_post_request()){
        $position_explode = explode('|', $_POST['position']);
        $position = $position_explode[0];
        $jd_doc_id = $position_explode[1];

        $update = [];
        $update['candidate_id'] = $id;
        $update['user_id'] = $candidate['user_id'];
        $update['first_name'] = $_POST['first_name'];
        $update['last_name'] = $_POST['last_name'];
        // $update['email'] = $_POST['email'];
        $update['recruiter'] = $_POST['recruiter'];
        $update['company'] = $_POST['company'];
        $update['position'] = $position;
        $update['interview_date'] = $_POST['interviewDate'];
        $update['interview_time'] = $_POST['interviewTime'];
        $update['region'] = $_POST['region'];
        $_SESSION['update'] = $update;
        
        $result = edit_candidate_recruiter($update);
        if ($result === true) {
            $_SESSION['message'] = "User has been updated.";
            
        }else{
            $_SESSION['error']=$result;
        }

        if($update['position'] != $candidate['position_id']){
            $old_jd_set = get_jd_doc_id($candidate['position_id']);
           
            $old_jd = $old_jd_set[0]['jd_doc_id'];
            $new_jd_set = get_jd_doc_id($update['position']);
            $new_jd = $new_jd_set[0]['jd_doc_id'];
           

            $inactive_result = make_doc_inactive($candidate['candidate_id'], $old_jd);
            if ($inactive_result === false) {
                $errors = $inactive_result;
            }

            $jd_exists = jd_in_doc_list($document_list, $new_jd);
            if($jd_exists === false){
                $new_jd_result = add_new_jd($candidate['candidate_id'], $new_jd);
                
                if ($new_jd_result === false){
                    $errors = $new_jd_result;
                }
            }else{
                $active_result = make_doc_active($candidate['candidate_id'], $new_jd);
                if ($active_result === false) {
                    $errors = $inactive_result;
                }
            }
            $new_jd_status = get_jd_status($candidate['candidate_id'], $new_jd);
            $_POST['jd_status'] = $new_jd_status[0]['status_id'];
        }
        redirect_to(url_for('/recruiter/index.php'));
    }
?>

<?php $page_title = 'View Candidate'; ?>
<?php include(SHARED_PATH . '/recruiter_header.php'); ?>

<div id="content">

   <div class="row m-3" id="top-ribbon">
        <div class="col-lg-2">
            <a class="p-4" href="<?php echo url_for('/recruiter/index.php'); ?>" onclick="return confirm('Any changes made will not be saved.')">&laquo; Return to List</a>
            </div>
    <div class="col-lg-10 d-flex justify-content-end" id="edit-form-btn">
        <button form="edit-form" type="submit" class="btn">Update</button>
        <button form="edit-form" type="reset" value="Cancel" class="btn btn-info" id="cancel">Reset</button>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <form id="edit-form" form="edit-form" action="<?php echo url_for('/recruiter/edit.php?id=' . $candidate['candidate_id']); ?>" method="post">
                   
                <div class="card-header py-3 d-flex justify-content-center" id="candidate_chead">
                    <div id="name-div">
                        <input class="m-0 font-weight-bold text-center" type="text" id="name" name="first_name" value="<?php echo h($candidate['first_name']); ?>"/>
                        <input class="m-0 font-weight-bold text-center" type="text" id="last_name" name="last_name" value="<?php echo h($candidate['last_name']); ?>"/>
                    </div>
                   
                </div>  <!-- Card Header End -->
                <div class="card-body" id="card-padding">
                    <div class="row m-4">
                        <div class="col-4">
                            <p class="m-0"><label>Email:</label><?php echo($candidate['email']); ?></p>
                            <label>Recruiter:</label>
                            <select id="recruiter" type="select" name="recruiter" value="<?php echo($candidate['recruiter']); ?>" onchange="return confirm('Changing the recruiter will remove this candidate from your list.')">
                                <?php foreach ($recruiter_set as $recruiter) { ?>
                                        <option value="<?php echo $recruiter['recruiter_id'] ?>" <?php echo($recruiter['recruiter_id'] === $candidate['recruiter_id'] ? 'selected' : ''); ?>><?php echo ($recruiter['first_name'] . " " . $recruiter['last_name']); ?></option>    
                                    <?php } ?>
                            </select>
                            
                            <p><label>Disposition:</label> <?php echo($candidate['disposition']); ?></p>
                            
                        </div> <!-- Form Col End -->
                        

                        <div class="col-4">
                            <label>Company:</label> 
                            <select id="company" type="select" name="company" value="<?php echo($candidate['company']); ?>">
                            <?php foreach ($company_set as $company) { ?>
                                        <option value="<?php echo $company['id'] ?>" <?php echo($company['company'] === $candidate['company'] ? 'selected' : ''); ?>><?php echo $company['company'] ?></option>    
                                    <?php } ?>
                            </select> <br/>

                            <label>Position:</label> 
                            <select id="position" type="select" name="position" value="<?php echo($candidate['position']); ?>">
                               <?php 
                               $pos_set = ($candidate['company_id'] == '2' ? $ll_position_set : $cw_position_set);
                               foreach ($pos_set as $position) { ?>
                               <option value="<?php echo $position['id'] . '|' . $position['jd_doc_id']?>" <?php echo($candidate['position_id'] == $position['id'] ? 'selected' : ''); ?>><?php echo $position['title'] ?></option>
                               <?php }; ?>
                               
                            </select>
                            <br/>
                            <label>Impact Institute Date:</label> <span><?php echo($candidate['ii_date'] == 0000-00-00 ? 'TBD' : date('m/d/Y', strtotime($candidate['ii_date']))); ?></span>
                        </div> <!-- Form Col End -->
                        <div class="col-4">
                            <label>Panel Interview Date:</label> <input id="interviewDate" type="date" name="interviewDate" value="<?php echo(h($candidate['interview_date']) > 0000-00-00 ? $candidate['interview_date'] : ''); ?>"/>
                            <br>
                            <label>Panel Interview Time:</label> <input id="interviewTime" type="time" name="interviewTime" value="<?php echo(h($candidate['interview_time']) > 0 ? $candidate['interview_time'] : ''); ?>"/>
                            <br>
                            <label>Panel Interview District for Zoom Link:</label> 
                            <select id="region" type="select" name="region">
                            <?php foreach ($region_set as $region) { ?>
                                        <option value="<?php echo $region['id'];?>" <?php echo($region['id'] === $candidate['region_id'] ? 'selected' : ''); ?>><?php echo $region['name'] ?></option>    
                                    <?php } ?>
                            </select>
                        </div> <!-- Form Col End -->
                        
                    </form>
                    </div> <!-- Form Row End -->
                    </div>
                    </div>

                    <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">   
                        <div class="card-header justify-content-center text-center">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3>Notes</h3>
                                </div> <!-- Col End -->
                            </div> <!-- Row End -->
                        </div> <!-- Card-Header End -->
                <div class="card-body">
                    <div class="row m-4">
                        <div class="col-12">
                                <span class="textarea resize-ta" id="notes" name="notes" style="width: 100%"><?php echo $candidate['notes']; ?></span>
                                <!-- <textarea id="notes" name="notes" rows="10" cols="100"></textarea> -->
                        </div> <!-- Card Body End -->
                    </div> <!-- Col End -->
                </div> <!-- Row End -->


                    </div> <!-- Card End -->
                </div> <!-- Col End -->
            </div> <!-- Row End -->
                        

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">   
                    <div class="card-header justify-content-center text-center">
                        <div class="row">
                                <div class="col-lg-12">
                                    <h3>Documents</h3>
                                </div>
                        </div>
                            
                            <div class="row">
                                <div class="col-lg-12" id="edit-form">
                                    <label class="pt-0">Application: </label>
                                    <span><?php echo(document_in_document_list($document_list, '15')); ?></span>
                                    </div>
                      
                    </div>
                    </div>
                    <div class="row justify-content-center mt-4 m-0 text-center">
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-1">
                                <!-- <p class="my-0 flex-grow-1">Job Description</p> -->
                                <p class="my-0 flex-grow-1">1. Job Description</p>
                            </div> <!--End Card Header -->

                            <div class="card-body">
                                <p class="card-text"><?php echo(get_job_desc($document_list)); ?></p>
                            </div> <!-- End Card body -->
                            </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-2 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">2. Disclosure</p>
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p class="card-text"><?php echo(document_in_document_list($document_list, '4')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-3 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">3. LEA</p>
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '5')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-4 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">4. Background Check</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '6')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-5 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">5. Panel Interview</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '13')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        
                    </div> <!-- End Column -->
                </div> <!-- End Row -->
                
                        
                        
                        <div class="row d-flex justify-content-center m-0 text-center"> <!-- m-4 justify-content-center"> -->
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-6 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">6. Job Offer</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '7')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                    <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-7 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">7. Transcripts</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '8')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                    <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-8 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">8. Fingerprinting</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '9')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                    <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-9 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">9. Reference Check</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '10')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                    <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-10 d-flex align-items-center justify-content-center h-100">
                                <p class="my-0 flex-grow-1">10. UltiPro Onboarding</p>
                            </div> <!--End Card Header -->
                            <div class="card-body flex-column h-100">
                                <p><?php echo(document_in_document_list($document_list, '11')); ?></p>
                            </div> <!-- End Card Body -->
                        </div> <!-- End Card -->
                   </div> <!-- End Col -->
                </div> <!-- End Row -->
                </div> <!-- Card Body End -->
            </div>  <!-- Card End -->
            </div> <!-- End Card Group -->
        </div>  <!-- Col End -->
    </div>  <!-- Row End -->
    

</div> <!-- Content End -->


<?php include(SHARED_PATH . '/hr_footer.php'); ?>  

<script>
function resizeInput() {
    $(this).attr('size', $(this).val().length);
}

$(document).ready(function(){
        $("#company").change(function(){
            var c = $(this);
            var ll = '<select id="position" type="select" name="position" value="<?php echo($candidate['position']); ?>"><?php foreach ($ll_position_set as $position) { ?><option value="<?php echo $position['id'] . '|' . $position['jd_doc_id']?>" <?php echo($candidate['position_id'] == $position['id'] ? 'selected' : ''); ?>><?php echo $position['title'] ?></option><?php } ?>';
            var cw = '<select id="position" type="select" name="position" value="<?php echo($candidate['position']); ?>"><?php foreach ($cw_position_set as $position) { ?><option value="<?php echo $position['id'] . '|' . $position['jd_doc_id']?>" <?php echo($candidate['position_id'] == $position['id'] ? 'selected' : ''); ?>><?php echo $position['title'] ?></option><?php } ?>';
            var ll_reg = '<select id="region" name="region" required><?php foreach ($region_set as $region) { ?><option value="<?php echo $region['id'] ?>" <?php echo($region['id'] === $candidate['region_id'] ? 'selected' : ''); ?> <?php echo($region['id'] == '24' ? 'style="display:none;"' : '') ?>><?php echo $region['name'] ?></option><?php } ?></select>';
            var cw_reg = '<select id="region" name="region" required><option value = "24" selected>Crosswinds</option></select>';
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
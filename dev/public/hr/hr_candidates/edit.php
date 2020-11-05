<?php require_once('../../../private/initialize.php'); 
    require_login();

    $company_set = all_companies();
    $position_set = all_positions();
    $region_set = all_regions();
    $recruiter_set = all_recruiters();
    $status_set = all_status();
    $ii_dates = all_ii_dates();


    if(!isset($_GET['id'])){
        redirect_to(url_for('/hr/index.php'));
    }

    $id = $_GET['id'];

    $candidate_list = get_candidate_by_id($id);
    $candidate = $candidate_list[0];

    $document_list = documents_by_candidate($id);
    $link = [];
    $link['jd'] = get_jd_link($document_list);
    $link['disc'] = get_doc_link($document_list, '4');
    $link['lea'] = get_doc_link($document_list, '5');
    $link['bcg'] = get_doc_link($document_list, '6');
    

    if(is_post_request()){
        $update = [];
        $update['candidate_id'] = $id;
        $update['user_id'] = $candidate['user_id'];
        $update['first_name'] = $_POST['first_name'];
        $update['last_name'] = $_POST['last_name'];
        $update['email'] = $_POST['email'];
        $update['recruiter'] = $_POST['recruiter'];
        $update['disposition'] = $_POST['status'];
        $update['company'] = $_POST['company'];
        $update['position'] = $_POST['position'];
        $update['interview_date'] = $_POST['interviewDate'];
        $update['interview_time'] = $_POST['interviewTime'];
        $update['start_date'] = $_POST['startDate'];
        $update['ii_date'] = $_POST['iiDate'];


        

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

        $jd_id_array = get_jd_doc_id($update['position']);
        $jd_id = $jd_id_array[0]['jd_doc_id'];

        $doc_status_update['jd'] = $_POST['jd_status'];
        $doc_status_update['disc'] = $_POST['disc_status'];
        $doc_status_update['lea'] = $_POST['lea_status'];
        $doc_status_update['bcg'] = $_POST['bcg_status'];
        $doc_status_update['panel'] = $_POST['panel_status'];
        $doc_status_update['offer'] = $_POST['offer_status'];
        $doc_status_update['trans'] = $_POST['trans_status'];
        $doc_status_update['fprint'] = $_POST['fprint_status'];
        $doc_status_update['ref'] = $_POST['ref_status'];
        $doc_status_update['ultipro'] = $_POST['ultipro_status'];
        

        $result = edit_candidate_hr($update, $doc_status_update, $jd_id);
        
        if ($result === false) {
            $errors = $result;
        }

        if($update['disposition'] == 12){
            $result = change_user_status($update['user_id'], 0);
            if ($result === false) {
                $errors = $result;
            }
        }

        if($candidate['disposition'] == 12 && $update['disposition'] != 12){
            $result = change_user_status($update['user_id'], 1);
            if ($result === false) {
                $errors = $result;
            }
        }

        $link_upload['jd'] = $_POST['jd_link_upload'];
        $link_upload['disc'] = $_POST['disc_link_upload'];
        $link_upload['lea'] = $_POST['lea_link_upload'];
        $link_upload['bcg'] = $_POST['bcg_link_upload'];
        

        $result = update_document_links($id, $jd_id, $link_upload);

        if ($result === true){
            $_SESSION['message'] = "Document links updated.";
            
        }else{
            $errors = $result; 
        }
        redirect_to(url_for('/hr/index.php'));
    }
            
?>

<?php $page_title = 'View Candidate'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>


<div id="content">

<a href="<?php echo url_for('/hr/index.php'); ?>">&laquo; Return to List</a>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <form id="edit-form" form="edit-form" action="<?php echo url_for('/hr/hr_candidates/edit.php?id=' . $candidate['candidate_id']); ?>" method="post">
                   
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
                            <br>
                            <label>Disposition:</label>
                            <select id="status" type="select" name="status" value="<?php echo($candidate['disposition']); ?>">
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" <?php echo($status['status'] === $candidate['disposition'] ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                            </select>
                        </div> <!-- Form Col End -->

                        <div class="col-3">
                            <label>Company:</label> 
                            <select id="company" type="select" name="company" value="<?php echo($candidate['company']); ?>">
                            <?php foreach ($company_set as $company) { ?>
                                        <option value="<?php echo $company['id'] ?>" <?php echo($company['company'] === $candidate['company'] ? 'selected' : ''); ?>><?php echo $company['company']; ?></option>    
                                    <?php } ?>
                            </select> <br/>
                            <label>Position:</label> 
                            <select id="position" type="select" name="position" value="<?php echo($candidate['position']); ?>">
                            <?php foreach ($position_set as $position) { ?>
                                        <option value="<?php echo $position['id'];?>" <?php echo($position['title'] === $candidate['position'] ? 'selected' : ''); ?>><?php echo $position['title']; ?></option>    
                                    <?php } ?>
                            </select><br/>
                            <label>Region:</label> 
                            <select id="region" type="select" name="region" value="<?php echo($candidate['region']); ?>">
                            <?php foreach ($region_set as $region) { ?>
                                        <option value="<?php echo $region['id'];?>" <?php echo($region['id'] === $candidate['region_id'] ? 'selected' : ''); ?>><?php echo $region['name']; ?></option>    
                                    <?php } ?>
                            </select>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <label>Interview Date:</label> <input id="interviewDate" type="date" name="interviewDate" value="<?php echo(h($candidate['interview_date'])); ?>"/>
                            <br>
                            <label>Interview Time:</label> <input id="interviewTime" type="time" name="interviewTime" value="<?php echo(h($candidate['interview_time'])); ?>"/>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <label>Start Date:</label> <input id="startDate" type="date" name="startDate" value="<?php echo($candidate['start_date']); ?>"/>
                            <br>
                            <label>Impact Institute Date:</label> 
                            <select id="iiDate" type="select" name="iiDate">
                            <option value="" <?php echo(is_blank($candidate['ii_date']) ? 'selected' : ''); ?>></option>
                            <?php foreach ($ii_dates as $date) { ?>
                                <option value="<?php echo $date['date']; ?>" <?php echo($date['date'] === $candidate['ii_date'] ? 'selected' : ''); ?>><?php echo $date['date']; ?></option>
                            <?php } ?>
                            </select>
                        </div> <!-- Form Col End -->
                        </div> <!-- Row End -->
                       
                    <div class="row m-4 d-flex align-items-center justify-content-center">
                        
                        <h3>Documents</h3>
                        
                    </div>
                    <div class="row justify-content-center m-0 text-center">
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header c-card-1">
                                <p class="my-0 flex-grow-1">Job Description</p>
                            </div> <!--End Card Header -->

                            <div class="card-body">
                            <select class="doc-status card-text" id="jd_status" type="select" name="jd_status">
                                    <option value="" <?php echo(is_blank(get_job_desc($document_list)) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (get_job_desc($document_list)) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                            </select>
                                <label class="mt-2 mb-0">Update Document Link</label>
                                <input class="m-0 p-0" type="text" name="jd_link_upload"/>
                                
                            
                            </div> <!-- End Card body -->
                            <div class="card-footer">
                                <?php echo add_doc_link($link['jd']);  ?>
                            </div>
                            </div> <!-- End Card -->
                            </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header c-card-2">
                                <p class="my-0 flex-grow-1">Disclosure</p>
                            </div> <!--End Card Header -->
                            <div class="card-body">  
                                <select class="doc-status" id="disc_status" type="select" name="disc_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '4')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '4')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                                <label class="mt-2 mb-0">Update Document Link</label>
                                <input class="m-0 p-0" type="text" name="disc_link_upload"/>
                                
                            </div> <!-- End Card Body -->
                            <div class="card-footer">
                            <?php echo add_doc_link($link['disc']);  ?>
                            </div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header c-card-3">
                                <p class="my-0 flex-grow-1">LEA</p>
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="lea_status" type="select" name="lea_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '5')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '5')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                                <label class="mt-2 mb-0">Update Document Link</label>
                                <input class="m-0 p-0" type="text" name="lea_link_upload"/>
                            </div> <!-- End Card Body -->
                            <div class="card-footer">
                            <?php echo add_doc_link($link['lea']);  ?>
                            </div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header c-card-4">
                                <p class="my-0 flex-grow-1">Background Check</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="bcg_status" type="select" name="bcg_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '6')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '6')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                                <label class="mt-2 mb-0">Update Document Link</label>
                                <input class="m-0 p-0" type="text" name="bcg_link_upload"/>
                            </div> <!-- End Card Body -->
                            <div class="card-footer">
                            <?php echo add_doc_link($link['bcg']);  ?>
                            </div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header c-card-5">
                                <p class="my-0 flex-grow-1">Panel Interview</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="panel_status" type="select" name="panel_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '13')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '13')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                                </form>
                            
                            </div> <!-- End Card Body -->
                            <div class="card-footer"></div>
                        </div> <!-- End Card -->
                   </div>  <!--End Card Group -->
                </div> <!-- End Row -->
                

    <div class="row d-flex justify-content-center m-0 text-center">
            <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header c-card-6">
                                <p class="my-0 flex-grow-1">Job Offer</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="offer_status" type="select" name="offer_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '7')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '7')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                                                
                        <div class="col-lg-2 col-md-4 mb-4">    
                        <div class="card">
                            <div class="card-header c-card-7">
                                <p class="my-0 flex-grow-1">Transcripts</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="trans_status" type="select" name="trans_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '8')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '8')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header c-card-8">
                                <p class="my-0 flex-grow-1">Fingerprinting</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="fprint_status" type="select" name="fprint_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '9')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '9')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header c-card-9">
                                <p class="my-0 flex-grow-1">Reference Check</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="ref_status" type="select" name="ref_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '10')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '10')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header c-card-10">
                                <p class="my-0 flex-grow-1">UltiPro Onboarding</p>
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="ultipro_status" type="select" name="ultipro_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '11')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '11')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer"></div>
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

$('input[type="text"]')
    // event handler
    .keyup(resizeInput)
    // resize on page load
    .each(resizeInput);

    $('input[type="option"]')
    // event handler
    .keyup(resizeInput)
    // resize on page load
    .each(resizeInput);


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
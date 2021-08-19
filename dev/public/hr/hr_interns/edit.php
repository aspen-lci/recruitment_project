<?php require_once('../../../private/initialize.php'); 
    require_login();

    $company_set = all_companies();
    $ll_position_set = all_positions_by_company(2);
    $cw_position_set = all_active_positions(3);
    $region_set = all_regions();
    $recruiter_set = all_recruiters();
    $ii_dates = all_ii_dates();
    $disposition_set = all_dispositions();
    $status_set = all_doc_status();


    if(!isset($_GET['id'])){
        redirect_to(url_for('/hr/hr_interns/interns.php'));
    }

    $id = $_GET['id'];

    $candidate_list = get_candidate_by_id($id);
    $candidate = $candidate_list[0];
    $notes = get_notes_by_candidate_id($id);

    if(!$notes){
        $candidate['notes'] = '';    
    }else{
    $candidate['notes'] = $notes[0]['note_text'];
    }

    $document_list = documents_by_candidate($id);
    $link = [];
    $link['jd'] = get_jd_link($document_list);
    $link['disc'] = get_doc_link($document_list, '4');
    $link['lea'] = get_doc_link($document_list, '5');
    $link['bcg'] = get_doc_link($document_list, '6');
    

    if(is_post_request()){
        
        $position_explode = explode('|', $_POST['position']);
        $position = $position_explode[0];
        $jd_doc_id = $position_explode[1];

        $update = [];
        $update['candidate_id'] = $id;
        $update['user_id'] = $candidate['user_id'];
        $update['first_name'] = $_POST['first_name'];
        $update['last_name'] = $_POST['last_name'];
        $update['recruiter'] = $_POST['recruiter'];
        $update['disposition'] = $_POST['status'];
        $update['company'] = $_POST['company'];
        $update['position'] = $position;
        $update['intern'] = $_POST['intern'];
        //$update['interview_date'] = $_POST['interviewDate'];
        //$update['interview_time'] = $_POST['interviewTime'];
        //$update['start_date'] = $_POST['startDate'];
        $update['ii_date'] = $_POST['iiDate'];
      	$update['region'] = $_POST['region'];
        
        $new_notes = $_POST['notes'] ?? '';

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

        $doc_status_update['app'] = $_POST['application'];
        $doc_status_update['jd'] = $_POST['jd_status'];
        $doc_status_update['disc'] = $_POST['disc_status'];
        $doc_status_update['lea'] = $_POST['lea_status'];
        $doc_status_update['bcg'] = $_POST['bcg_status'];
        $doc_status_update['agreement'] = $_POST['agreement_status'];
        $doc_status_update['offer'] = $_POST['offer_status'];
        $doc_status_update['trans'] = $_POST['trans_status'];
        $doc_status_update['fprint'] = $_POST['fprint_status'];
        $doc_status_update['ref'] = $_POST['ref_status'];
        $doc_status_update['ultipro'] = $_POST['ultipro_status'];
        $doc_status_update['contract'] = $_POST['contract_status'];
        $doc_status_update['liability'] = $_POST['liability_status'];
        
        if($candidate['disposition_id'] <= 5 && $update['disposition'] == 7){
            if($candidate['company_id'] == 2){
            $doc_status_update['offer'] = 1;
            $doc_status_update['trans'] = 1;
            $doc_status_update['fprint'] = 1;
            $doc_status_update['ref'] = 1;
            $doc_status_update['ultipro'] = 1;
            $doc_status_update['agreement'] = 1;
            $doc_status_update['contract'] = 1;
            $doc_status_update['liability'] = 1;
            
            }

            if($candidate['company_id'] == 3){
                $doc_status_update['offer'] = 1;
                $doc_status_update['trans'] = 1;
                $doc_status_update['fprint'] = 13;
                $doc_status_update['ref'] = 1;
                $doc_status_update['ultipro'] = 1;
            }
        }

        $result = edit_intern_hr($update, $doc_status_update, $jd_id);
        
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

        $link_upload['jd'] = (!is_blank($_POST['jd_link_upload']) ? http($_POST['jd_link_upload']) : '');
        $link_upload['disc'] = (!is_blank($_POST['disc_link_upload']) ? http($_POST['disc_link_upload']) : '');
        $link_upload['lea'] = (!is_blank($_POST['lea_link_upload']) ? http($_POST['lea_link_upload']) : '');
        $link_upload['bcg'] = (!is_blank($_POST['bcg_link_upload']) ? http($_POST['bcg_link_upload']) : '');
        

        $result = update_document_links($id, $jd_id, $link_upload);

        if ($result === true){
            $_SESSION['message'] = "Document links updated.";
            
        }else{
            $errors = $result; 
        }

        if($candidate['notes'] == ''){
            $create_note = create_candidate_note($id, $new_notes);
            if ($create_note === false) {
                $errors = $create_note;
            }
        }else{
            $update_note = update_candidate_note($id, $new_notes);
            if ($update_note === false) {
                $errors = $update_note;
            }
        }

        redirect_to(url_for('/hr/hr_interns/interns.php'));
    }
            
?>

<?php $page_title = 'View Candidate'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>


<div id="content">

<div class="row m-3" id="top-ribbon">
    <div class="col-lg-2">
        <a href="<?php echo url_for('/hr/hr_interns/interns.php'); ?>" onclick="return confirm('Any changes made will not be saved.')" >&laquo; Return to List</a>
    </div>
    
    <div class="col-lg-10 d-flex justify-content-end" id="edit-form-btn">
        <button form="edit-form" type="submit" class="btn">Update</button>
        <button form="edit-form" type="reset" value="Cancel" class="btn btn-info" id="cancel">Reset</button>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <form id="edit-form" form="edit-form" action="<?php echo url_for('/hr/hr_interns/edit.php?id=' . $candidate['candidate_id']); ?>" method="post">
                   
                <div class="card-header py-3 d-flex justify-content-center" id="candidate_chead">
                    <div id="name-div">
                        <input class="m-0 font-weight-bold text-center" type="text" id="name" name="first_name" value="<?php echo h($candidate['first_name']); ?>"/>
                        <input class="m-0 font-weight-bold text-center" type="text" id="last_name" name="last_name" value="<?php echo h($candidate['last_name']); ?>"/>
                    </div>
                    
                </div>  <!-- Card Header End -->
                <div class="card-body">
                    <div class="row m-4">
                        <div class="col-4">
                            <p class="m-0"><label>Email: </label><?php echo($candidate['email']); ?></p>
                            <label>Recruiter:</label>
                            <select id="recruiter" type="select" name="recruiter" value="<?php echo($candidate['recruiter']); ?>">
                                <?php foreach ($recruiter_set as $recruiter) { ?>
                                        <option value="<?php echo $recruiter['recruiter_id'] ?>" <?php echo($recruiter['recruiter_id'] === $candidate['recruiter_id'] ? 'selected' : ''); ?>><?php echo ($recruiter['first_name'] . " " . $recruiter['last_name']); ?></option>    
                                    <?php } ?>
                            </select>
                            <br>
                            <label>Disposition:</label>
                            <select id="status" type="select" name="status" value="<?php echo($candidate['disposition']); ?>">
                                    <?php foreach ($disposition_set as $disposition) { ?>
                                        <option value="<?php echo $disposition['status_id'] ?>" <?php echo($disposition['status'] === $candidate['disposition'] ? 'selected' : ''); ?>><?php echo ($disposition['status']); ?></option>
                                    <?php } ?>
                            </select>
                           
                        </div> <!-- Form Col End -->

                        <div class="col-4">
                            <label>Company:</label> 
                            <select id="company" type="select" name="company" value="<?php echo($candidate['company']); ?>">
                            <?php foreach ($company_set as $company) { ?>
                                        <option value="<?php echo $company['id'] ?>" <?php echo($company['company'] === $candidate['company'] ? 'selected' : ''); ?>><?php echo $company['company']; ?></option>    
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
                            <input class="ml-4" type="checkbox" id="intern" name="intern" value=1 <?php echo($candidate['intern'] == 1 ? 'checked' : ''); ?>>
                            <label for="intern"><b>INTERN</b></label>
                            <br/>
                            <label>Impact Institute Date:</label> 
                            <select id="iiDate" type="select" name="iiDate">
                                <option value="" <?php echo(is_blank($candidate['ii_date']) ? 'selected' : ''); ?>> </option>
                                <?php foreach($ii_dates as $date) echo('<option value=' . $date['date'] . ' ' . ($date['date'] == $candidate['ii_date'] ? 'selected' : '') . '>' . sprintf('%s</option>' . PHP_EOL, (new DateTime($date['date']))->format("m/d/Y"))); ?>
                            </select>

                        </div> <!-- Form Col End -->
                        <div class="col-4">
                            <!-- <label>Panel Interview Date:</label> <input id="interviewDate" type="date" name="interviewDate" value="<?php echo(h($candidate['interview_date']) > 0000-00-00 ? $candidate['interview_date'] : ''); ?>"/>
                            <br>
                            <label>Panel Interview Time:</label> <input id="interviewTime" type="time" name="interviewTime" value="<?php echo($candidate['interview_time'] > 0 ? h($candidate['interview_time']) : ''); ?>"/>
                            <br> -->
                            <label>Panel Interview Region:</label> 
                            <select id="region" type="select" name="region">
                            <?php foreach ($region_set as $region) { ?>
                                        <option value="<?php echo $region['id'];?>" <?php echo($region['id'] === $candidate['region_id'] ? 'selected' : ''); ?>><?php echo $region['name']; ?></option>    
                                    <?php } ?>
                            </select>
                           
                        </div> <!-- Form Col End -->
                        </div> <!-- Row End -->
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
                        <div class="col-12" id="edit-form">
                                <textarea class="textarea resize-ta text-left" id="notes" name="notes" <?php echo(is_blank($candidate['notes']) ? 'rows="3"' : 'rows="6"'); ?> style="width: 100%; height: 100%;"><?php echo $candidate['notes']; ?></textarea>
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
                                    <label class="pt-0">Application:</label>
                                    <select id="application" type="select" name="application">
                                        <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '15')) ? 'selected' : ''); ?>></option>
                                        <option value="4" style="width:100%;" <?php echo(document_in_document_list($document_list, '15') == 'Completed' ? 'selected' : ''); ?>>Completed</option>
                                        <option value="17" style="width:100%;" <?php echo(document_in_document_list($document_list, '15') == 'Not Submitted' ? 'selected' : ''); ?>>Not Submitted</option>
                                    </select>
                                </div>
                            </div>
                      
                    </div>
                    <div class="row justify-content-center mt-4 m-0 text-center">
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-1 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">1. Job Description</p>
                            </div> <!--End Card Header -->

                            <div class="card-body">
                            <select class="doc-status card-text" id="jd_status" type="select" name="jd_status">
                                    <option value="" <?php echo(is_blank(get_job_desc($document_list)) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (get_job_desc($document_list)) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                            </select>
                                <label class="mt-2 mb-0">Update Document Link</label>
                                <input class="doc-status m-0 p-0" type="text" name="jd_link_upload"/>
                                
                            
                            </div> <!-- End Card body -->
                            <div class="card-footer c-card-1 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <?php echo (is_blank($link['jd']) ? '' : add_doc_link(http($link['jd'])));  ?>
                            </div>
                            </div> <!-- End Card -->
                            </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-2 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">2. Disclosure</p>
                            </div> <!--End Card Header -->
                            <div class="card-body">  
                                <select class="doc-status" id="disc_status" type="select" name="disc_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '4')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '4')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                                <label class="mt-2 mb-0">Update Document Link</label>
                                <input class="doc-status m-0 p-0" type="text" name="disc_link_upload"/>
                                
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-2 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                            <?php echo (is_blank($link['disc']) ? '' : add_doc_link(http($link['disc'])));  ?>
                            </div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-3 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">3. LEA</p>
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="lea_status" type="select" name="lea_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '5')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '5')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                                <label class="mt-2 mb-0">Update Document Link</label>
                                <input class="doc-status m-0 p-0" type="text" name="lea_link_upload"/>
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-3 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                            <?php echo (is_blank($link['lea']) ? '' : add_doc_link(http($link['lea'])));  ?>
                            </div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-4 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">4. Background Check</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="bcg_status" type="select" name="bcg_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '6')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '6')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                                <label class="mt-2 mb-0">Update Document Link</label>
                                <input class="doc-status m-0 p-0" type="text" name="bcg_link_upload"/>
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-4 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                            <?php echo (is_blank($link['bcg']) ? '' : add_doc_link(http($link['bcg'])));  ?>
                            </div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-5 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">5. Internship Offer</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="offer_status" type="select" name="offer_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '7')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '7')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                                
                            
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-5 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-6 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">6. Internship Agreement</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="agreement_status" type="select" name="agreement_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '21')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '21')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-6 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                </div> <!-- End Row -->
                

    <div class="row d-flex justify-content-center m-0 text-center">
            
                               
                        <div class="col-lg-2 col-md-4 mb-4">    
                        <div class="card h-100">
                            <div class="card-header c-card-7 pl-0 pr-0 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">7. Business Associates Contract</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="contract_status" type="select" name="contract_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '22')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '22')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-7 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                        <div class="col-lg-2 col-md-4 mb-4">    
                        <div class="card h-100">
                            <div class="card-header c-card-8  <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">8. Transcripts</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="trans_status" type="select" name="trans_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '8')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '8')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-8 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-9 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">9. Fingerprinting</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="fprint_status" type="select" name="fprint_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '9')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '9')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-9 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-10 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">10. Reference Check</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="ref_status" type="select" name="ref_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '10')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '10')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-10 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->
                        
                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-11 pl-0 pr-0 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">11. Proof of Liability Insurance</p> 
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="liability_status" type="select" name="liability_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '31')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '31')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-11 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>"></div>
                        </div> <!-- End Card -->
                        </div> <!-- End Column -->

                        <div class="col-lg-2 col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header c-card-12 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>">
                                <p class="my-0 flex-grow-1">12. UKG Onboarding</p>
                            </div> <!--End Card Header -->
                            <div class="card-body">
                                <select class="doc-status" id="ultipro_status" type="select" name="ultipro_status">
                                    <option value="" style="width:100%;" <?php echo(is_blank(document_in_document_list($document_list, '11')) ? 'selected' : ''); ?>></option>
                                    <?php foreach ($status_set as $status) { ?>
                                        <option value="<?php echo $status['status_id'] ?>" style="width:100%;" <?php echo($status['status'] === (document_in_document_list($document_list, '11')) ? 'selected' : ''); ?>><?php echo ($status['status']); ?></option>
                                    <?php } ?>
                                </select>
                                </form>
                            </div> <!-- End Card Body -->
                            <div class="card-footer c-card-12 <?php echo($candidate['company_id'] == 3 ? 'cw' : ''); ?>"></div>
                        </div> <!-- End Card -->
                   </div> <!-- End Card Group -->
                </div> <!-- End Row -->
                </div> <!-- Card Body End -->
            </div>  <!-- Card End -->
        </div>  <!-- Col End -->
    </div>  <!-- Row End -->
    </div>  
   

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

    $('#status').change(function (){
        if($(this).val() === '12')
            alert("Selecting inactive status will remove candidate from dashboard lists and make them an inactive user.");
    });

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



   // Dealing with Textarea Height
function calcHeight(value) {
  let numberOfLineBreaks = (value.match(/\n/g) || []).length;
  // min-height + lines x line-height + padding + border
  let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;
  return newHeight;
}

let textarea = document.querySelector(".resize-ta");
textarea.addEventListener("keyup", () => {
  textarea.style.height = calcHeight(textarea.value) + "px";
});


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
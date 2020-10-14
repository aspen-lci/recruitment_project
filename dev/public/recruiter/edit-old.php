<?php require_once('../../private/initialize.php'); 
    require_login();

    if(!isset($_GET['id'])){
        redirect_to(ur_for('/recruiter/index.php'));
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <form form="edit-form" action="<?php echo url_for('/recruiter/edit.php?id=' . $candidate['candidate_id']); ?>" method="post">
                    <div class="card-header py-3 d-flex justify-content-center" id="candidate_chead">
                    <h3 class="m-0 font-weight-bold text-center" type="text" id="name" name="first_name" value="<?php echo h($candidate['first_name']); ?>"><?php echo (h($candidate['first_name'])); ?></h3>
                    <h3 class="m-0 font-weight-bold text-center" id="last_name" data-type="text" data-pk="<?php echo h($candidate['candidate_id']); ?>" name="last_name"><?php echo (h($candidate['last_name'])); ?></h3>
                    <!-- <h3 class="m-0 font-weight-bold text-center" id="name" data-type="text" data-pk="<?php echo h($candidate['candidate_id']); ?>" data-name="name"><?php echo (h($candidate['first_name']) . ' ' . h($candidate['last_name'])); ?></h3> -->
                </div>  <!-- Card Header End -->
                <div class="card=body">
                    <div class="row m-4">
                        <div class="col-3">
                            <p>Email: <a href="#" id="email" data-type="text" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-name="email" data-value="<?php echo($candidate['email']); ?>"><?php echo($candidate['email']); ?></a></p>
                            <p>Disposition: <?php echo($candidate['disposition']); ?></p>
                        </div> <!-- Form Col End -->

                        <div class="col-3">
                            <p>Company: <a href="#" id="company" data-type="select" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-name="company" data-value="<?php echo($candidate['company']); ?>"><?php echo ($candidate['company']); ?></a></p>
                            <p>Position: <a href="#" id="position" data-type="select" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-name="position" data-value="<?php echo($candidate['position']); ?>"><?php echo($candidate['position']); ?></a></p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Interview Date: <a href="#" id="interviewDate" data-type="date" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-url="<?php echo url_for('/recruiter/edit.php?candidate_id' . h(u($candidate['candidate_id']))); ?>" method="post" data-name="interviewDate" data-value="<?php echo(h($candidate['interview_date'])); ?>"><?php echo(convert_date($candidate['interview_date'])); ?></a></p>
                            <p>Interview Time: <a href="#" id="interviewTime" data-type="time" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-name="interviewTime" data-value="<?php echo(h($candidate['interview_time'])); ?>"><?php echo(convert_time($candidate['interview_time'])); ?></a></p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Start Date: <a href="#" id="startDate" data-type="date" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-url="/post" data-name="startDate" data-value="<?php echo($candidate['start_date']); ?>"><?php echo(convert_date($candidate['start_date'])); ?></a></p>
                            <p>Impact Institute Date: <a href="#" id="iiDate" data-type="date" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-url="/post" data-name="iiDate" data-value="<?php echo($candidate['ii_date']); ?>"><?php echo(convert_date($candidate['ii_date'])); ?></a></p>
                        </div> <!-- Form Col End -->
                        <div class="form-row m-4">
                            <div class="form-group col">
                                <button form="edit-form" type="submit" class="btn">Submit</button>
                            </div> <!-- Form Col End -->
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
                            <h5>Lifeline Criminal History and Background Check:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '6')); ?></p>
                        </div> <!-- Form Col End -->
                        
                        <div class="col-md-4">
                            <h5>Job Offer:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '7')); ?></p>
                        </div> <!-- Form Col End -->
                        
                        <div class="col-md-4">
                            <h5>Transcripts Received:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '8')); ?></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4 doc_status">
                        <div class="col-md-4">
                            <h5>Fingerprinting Complete:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '9')); ?></p>
                        </div> <!-- Form Col End -->
                        
                        <div class="col-md-4">
                            <h5>Reference Check:</h5> 
                            <p><?php echo(document_in_document_list($document_list, '10')); ?></p>
                        </div> <!-- Form Col End -->
                        
                        <div class="col-md-4">
                            <h5>UltiPro Onboarding Complete:</h5>
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

        $('#company').editable({
            source:[
                {value: 'Lifeline', text: 'Lifeline'},
                {value: 'Crosswinds', text: 'Crosswinds'},
                {value: 'Lasting Change Inc', text: 'Lasting Change Inc'}
            ]
        });

        $('#position').editable({
            source:[
                {value: 'HBS Family Consultant', text: 'HBS Family Consultant'},
                {value: 'Homemaker', text: 'Homemaker'},
                {value: 'Therapist', text: 'Therapist'},
                {value: 'Youth Treatment Specialist', text: 'Youth Treatment Specialist'}
            ]
        });

        $('#email').editable();

        $('#startDate').editable({
            viewformat: 'mm/dd/yyyy'
            
        });

        $('#interviewDate').editable({
            viewformat: 'mm/dd/yyyy',
            
        });

        $('#interviewTime').editable();

        $('#iiDate').editable({
            viewformat: 'mm/dd/yyyy'
        });

        });

        
</script>
</body>
</html>
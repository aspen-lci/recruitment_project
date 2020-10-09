<?php require_once('../../private/initialize.php'); 

$candidate_list = get_candidate_by_id($_GET['id']);
$candidate = $candidate_list[0];

?>

<?php $page_title = 'View Candidate'; ?>
<?php include(SHARED_PATH . '/recruiter_header.php'); ?>

<div id="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <form action="<?php echo url_for('/recruiter/edit.php?id=' . $candidate['candidate_id']); ?>" method="post">
                <div class="card-header py-3 d-flex justify-content-center" id="candidate_chead">
                    <!-- <h3 class="m-0 font-weight-bold text-center" id="name" data-type="text" data-pk="<?php echo h($candidate['candidate_id']); ?>" data-name="name"><?php echo (h($candidate['first_name']) . ' ' . h($candidate['last_name'])); ?></h3> -->
                    <h3><?php echo (h($candidate['first_name']) . ' ' . h($candidate['last_name'])); ?></h3>
                </div>  <!-- Card Header End -->
                <div class="card=body">
                    <div class="row m-4">
                        <div class="col-3">
                            <p>Company: <a href="#" id="company" data-type="select" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-name="company" data-value="<?php echo($company); ?>"><?php echo ($candidate['company']); ?></a>                         
                            </p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Position: <a href="#" id="position" data-type="select" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-name="position" data-value="<?php echo($position); ?>"><?php echo($candidate['position']); ?></a></p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Start Date: <a href="#" id="startDate" data-type="date" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-name="startDate" data-value="<?php echo($startDate); ?>"><?php echo($candidate['start_date']); ?></a></p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Email: <a href="#" id="email" data-type="text" data-pk="<?php echo (h($candidate['candidate_id'])); ?>" data-name="email" data-value="<?php echo($email); ?>"><?php echo($candidate['email']); ?></a></p>
                        </div> <!-- Form Col End -->
                    </div> <!-- Form Row End -->
                        
                    <div class="row m-4">

                        <h3>Documents</h3>
                    </div> <!-- Form Row End -->
                    <div class="row m-4">
                        <div class="col">
                            <p>Job Description: </p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        
                        <div class="row m-4">
                        <div class="col">
                            <p>Disclosure: </p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        
                        <div class="row m-4">
                        <div class="col">
                            <p>LEA Background Check: </p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Lifeline Criminal History and Background Check: </p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Job Offer: </p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Transcripts Received: </p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Fingerprinting Complete: </p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Reference Check Complete: </p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>UltiPro Onboarding Complete: </p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                    </form>
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

        $('#company').editable({
            source:[
                {value: 'Lifeline', text: 'Lifeline'},
                {value: 'Crosswinds', text: 'Crosswinds'},
                {value: 'Lasting Change Inc', text: 'Lasting Change Inc'}
            ]
        });

        $('#position').editable({
            source:[
                {value: 'Homemaker', text: 'Homemaker'},
                {value: 'Therapist', text: 'Therapist'},
                {value: 'Family Consultant', text: 'Family Consultant'},
                {value: 'Youth Treatment Specialist', text: 'Youth Treatment Specialist'}
            ]
        });

        $('#email').editable();

        $('#startDate').editable({
            format: 'mm/dd/yyyy',    
            viewformat: 'mm/dd/yyyy',
            datepicker: {
                weekStart: 0
           }
        });

        });


</script>
</body>
</html>
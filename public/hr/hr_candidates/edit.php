<?php require_once('../../../private/initialize.php'); 



?>

<?php

    $id = $_GET['id'] ?? '1';
    $name = 'Angela Spencer';
    $jobDesc = 'JobDescription.pdf';
    $discForm = 'Disclosure.pdf';
    $lea = 'LEA.pdf';
    $lCheck = 'LLBackground.pdf';
    $jobOffer = 'JobOffer.pdf';
    $trans = true;
    $fPrint = false;
    $ref = false;
    $ultipro = true;
    $startDate = '09/10/2020';
    $position = 'Developer';
    $company = 'Lasting Change Inc.';
    $email = 'myemail@gmail.com';

    // echo h($id);

    if(is_post_request()){
        $name = $_POST['name'];
        $startDate = $_POST['startDate'];
        $position = $_POST['position'];
        $company = $_POST['company'];
        $email = $_POST['email'];
     
        echo "Form parameters<br />";
        echo "Name: " . $name . "<br />";
        echo "Start Date: " . $startDate . "<br />";
        echo "Position: " . $position . "<br />";
        echo "Company: " . $company . "<br />";
        echo "Email: " . $email . "<br />";
    }
?>

<?php $page_title = 'View Candidate'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<div id="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <form action="<?php echo url_for('hr/hr_candidates/create.php') ?>" method="post">
                <div class="card-header py-3 d-flex justify-content-center" id="candidate_chead">
                    <h3 class="m-0 font-weight-bold text-center" id="name" data-type="text" data-pk="<?php echo $id ?>" data-name="name"><?php echo ($name); ?></h3>
                </div>  <!-- Card Header End -->
                <div class="card=body">
                    <div class="row m-4">
                        <div class="col-3">
                            <p>Company: <a href="#" id="company" data-type="select" data-pk="<?php echo $id ?>" data-name="company" data-value="<?php echo($company); ?>"><?php echo ($company); ?></a>                         
                            </p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Position: <a href="#" id="position" data-type="select" data-pk="<?php echo $id ?>" data-name="position" data-value="<?php echo($position); ?>"><?php echo($position); ?></a></p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Start Date: <a href="#" id="startDate" data-type="date" data-pk="<?php echo $id ?>" data-name="startDate" data-value="<?php echo($startDate); ?>"><?php echo($startDate); ?></a></p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Email: <a href="#" id="email" data-type="text" data-pk="<?php echo $id ?>" data-name="email" data-value="<?php echo($email); ?>"><?php echo($email); ?></a></p>
                        </div> <!-- Form Col End -->
                    </div> <!-- Form Row End -->
                        
                    <div class="row m-4">

                        <h3>Documents</h3>
                    </div> <!-- Form Row End -->
                    <div class="row m-4">
                        <div class="col">
                            <p>Job Description: <a href="#"><?php echo($jobDesc); ?></a></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        
                        <div class="row m-4">
                        <div class="col">
                            <p>Disclosure: <a href="#"><?php echo($discForm); ?></a></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->
                        
                        <div class="row m-4">
                        <div class="col">
                            <p>LEA Background Check: <a href="#"><?php echo($lea); ?></a></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Lifeline Criminal History and Background Check: <a href="#"><?php echo($lCheck); ?></a></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Job Offer: <a href="#"><?php echo($jobOffer); ?></a></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Transcripts Received: <?php echo(checkmark($trans)); ?></p></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Fingerprinting Complete: <?php echo(checkmark($fPrint)); ?></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>Reference Check Complete: <?php echo(checkmark($ref)); ?></p>
                        </div> <!-- Form Col End -->
                        </div> <!-- Form Row End -->

                        <div class="row m-4">
                        <div class="col">
                            <p>UltiPro Onboarding Complete: <?php echo(checkmark($ultipro)); ?></p>
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
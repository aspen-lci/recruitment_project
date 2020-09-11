<?php require_once('../../../private/initialize.php'); ?>

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
    $startDate = '09/12/2020';
    $position = 'Developer';
    $company = 'Lasting Change Inc.';
    $email = 'myemail@gmail.com';

    // echo h($id);
?>

<?php $page_title = 'View Candidate'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<div id="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3" id="candidate_chead">
                    <a href="<?php echo url_for('/hr/hr_candidates/edit.php?id=' . h(u($id)));?>">Edit Candidate</a>
                    <h3 class="m-0 font-weight-bold text-center"><?php echo ($name); ?></h3>
                </div>  <!-- Card Header End -->
                <div class="card=body">
                    <div class="row m-4">
                        <div class="col-3">
                            <p>Company: <?php echo($company); ?></p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Position: <?php echo($position); ?></p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Start Date: <?php echo($startDate); ?></p>
                        </div> <!-- Form Col End -->
                        <div class="col-3">
                            <p>Email: <?php echo($email); ?></p>
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

                </div> <!-- Card Body End -->
            </div>  <!-- Card End -->
        </div>  <!-- Col End -->
    </div>  <!-- Row End -->

</div> <!-- Content End -->


<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
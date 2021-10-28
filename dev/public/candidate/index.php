<?php require_once('../../private/initialize.php'); 

$candidate = get_candidate_by_user_id($_SESSION['user_id']);
$candidate_id = $candidate[0]['candidate_id'];
$position_id = $candidate[0]['position_id'];
$position = $candidate[0]['position'];
$region_id = $candidate[0]['region_id'];
$start_date = $candidate[0]['start_date'];
$interview_date = $candidate[0]['interview_date'];
$interview_time = $candidate[0]['interview_time'];
$ii_date = $candidate[0]['ii_date'];
$company = $candidate[0]['company_id'];
$disposition = $candidate[0]['disposition_id'];

$documents = documents_by_candidate($candidate_id);

$jd_doc_id_value = get_jd_doc_id($position_id);
$jd_doc_id = $jd_doc_id_value[0]['jd_doc_id'];
$templates = get_templates();


$jd = get_template_link($templates, $jd_doc_id);

if($company == 2){
$disc = get_template_link($templates, 26);
$ack = get_template_link($templates, 25);
$video = url_for('/images/Lifeline.mp4');
$bio = url_for('/documents/bio sheet - lyfs.pdf');
$ii = url_for('/documents/New Hires First Week.pdf');
}

if($company == 3){
  $disc = get_template_link($templates, 24);
  $ack = get_template_link($templates, 23);
  $video = url_for('/images/Crosswinds.mp4');
  $bio = url_for('/documents/bio sheet - cw.pdf');
  $ii = url_for('/documents/New Hires First Week.pdf');
  }

  if($company == 4){
    $disc = get_template_link($templates, 24);
    $ack = get_template_link($templates, 23);
    $video = url_for('/images/Crosswinds.mp4');
    $bio = url_for('/documents/bio sheet - cw.pdf');
    $ii = url_for('/documents/New Hires First Week.pdf');
    }

if($company == 5){
  $disc = get_template_link($templates, 45);
  $ack = get_template_link($templates, 46);
  // $video = url_for('/images/Lifeline.mp4');
  $bio = url_for('/documents/bio sheet - pwash.pdf');
  $ii = url_for('/documents/New Hires First Week.pdf');
  }

$page_title = 'Welcome to Lifeline';
include(SHARED_PATH . '/candidate_header.php'); ?>



  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron">
      <div class="row" style="background-color: #F98E2C; <?php echo($company == 5 ? 'display: none' : ''); ?>;">
        <div class="col-5">
          <div class="video-container">
            <video controls>
                <source src="<?php echo $video; ?>" type="video/mp4">
              </video>
          </div>
          <div>
            <!-- <p id="jumbotron-text" class="text-center">We cannot wait to get to know you better!</p> -->
            <p style="color: white;">Please watch this video before completing the steps below.</p>
          </div>
        </div> <!-- end col -->
        <div class="col-7">
          <div>
            <img src="<?php echo url_for('/images/LL New Hire_CandidateLandingPage without photo.jpg') ?>" alt="hero_img" width="100%">
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->

      <div class="row" style="background-color: #F98E2C; display: <?php echo($company != 5 ? 'none' : 'inherit'); ?>;">
        <div class="col-12">
         
          
            <img src="<?php echo url_for('/images/LL New Hire_CandidateLandingPage 040921.jpg') ?>" alt="hero_img" width="100%">
          
        </div> <!-- end col -->
      </div> <!-- end row -->
    </header>
    
    <!-- Page Features -->
    <div class="row text-center">

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, $jd_doc_id, $disposition)); ?>;">
          <div class="card-header c-card-1 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>1</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Job Description</h4>
            <div <?php echo(card_body_status($documents, $jd_doc_id)); ?>>
              <p class="card-text">Please sign and return.</p>
              <p class="card-text">Note: Please use the same email used to sign in to this portal for SignNow.</p>
              <a href="<?php echo $jd; ?>" target="_blank" class="btn btn-outline-lli btn-small" <?php echo(card_body_status($documents, $jd_doc_id)); ?>><?php echo $position; ?> Job Description</a>
            </div>
            <p class="doc_status" <?php echo(display_card_body_status($documents, $jd_doc_id)); ?>><?php echo(document_in_document_list($documents, $jd_doc_id)); ?></p>
          </div>
          <div class="card-footer c-card-1 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>"></div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 4, $disposition)); ?>;">
          <div class="card-header c-card-2 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>2</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Disclosure Form</h4>
            <div <?php echo(card_body_status($documents, 4)); ?>>
              <p class="card-text">First, Middle, and Last Name required! Please sign and date both forms. </p>
              <p class="card-text">Note: Please use the same email used to sign in to this portal for SignNow.</p>
              <a href="<?php echo $disc; ?>" target="_blank" class="btn btn-outline-lli btn-small">Disclosure</a>
              <a href="<?php echo $ack; ?>" target="_blank" class="btn btn-outline-lli btn-small">Acknowledgement</a>
            </div>
            <p class="doc_status" <?php echo(display_card_body_status($documents, '4')); ?>><?php echo(document_in_document_list($documents, 4)); ?></p>
          </div>
          <div class="card-footer c-card-2 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
           
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 5, $disposition)); ?>;">
          <div class="card-header c-card-3 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>3</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">LEA Form</h4>
            <div <?php echo(card_body_status($documents, 5)); ?>>
              <p class="card-text">Note: Please use the same email used to sign in to this portal for SignNow.</p>
              <a href="lea.php" class="btn btn-outline-lli btn-small mt-3">Instructions and Form</a>
            </div>
            <p class="doc_status" <?php echo(display_card_body_status($documents, 5)); ?>><?php echo(document_in_document_list($documents, 5)); ?></p>
          </div>
          <div class="card-footer c-card-3 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            
          </div>
        </div>
      </div>

     
    </div>
    <!-- /.row -->

    <div class="row text-center">
      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 6, $disposition)); ?>;">
          <div class="card-header c-card-4 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>4</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Criminal History & Background Check</h4>
            <div <?php echo(card_body_status($documents, 6)); ?>>
              <p class="card-text">Note: Please use the same email used to sign in to this portal for SignNow.</p>
              <a href="crimhist.php" class="btn btn-outline-lli btn-small mt-3">Instructions and Form</a>
            </div>
            <p class="doc_status" <?php echo(display_card_body_status($documents, 6)); ?>><?php echo(document_in_document_list($documents, 6)); ?></p>
          </div>
          <div class="card-footer c-card-4 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 13, $disposition)); ?>;">
          <div class="card-header c-card-5 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>" >
            <h4>5</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Panel Interview</h4>
            <div <?php echo(card_body_status($documents, 13)); ?>>
              <p class="card-text">Open the box below for details and necessary preparation materials.</p>
              <p class="card-text">Good luck on your interview!</p>
              <a href="panel.php" class="btn btn-outline-lli btn-small mt-3">Necessary Interview Materials</a>
            </div>
            <p class="doc_status" <?php echo(display_card_body_status($documents, 13)); ?>><?php echo(document_in_document_list($documents, 13)); ?></p>
          </div>
          <div class="card-footer c-card-5 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 7, $disposition)); ?>;">
          <div class="card-header c-card-6 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>6</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Accept and sign the job offer</h4>
            <div <?php echo(card_body_status($documents, 7)); ?>>
              <p class="card-text" id="job-text">Please sign and return the official offer received in your email from joinus@lastingchangeinc.org so we can move you along to the next step!</p>
            </div>
            <p class="doc_status" <?php echo(display_card_body_status($documents, 7)); ?>><?php echo(document_in_document_list($documents, 7)); ?></p>
           </div>
          <div class="card-footer c-card-6 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            
          </div>
      </div>
      </div>

    </div>
    <!-- end row-->

    <div class="row text-center">
    <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 8, $disposition)); ?>";>
          <div class="card-header c-card-7 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>7</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Send in your transcripts</h4>
            <div <?php echo(card_body_status($documents, 8)); ?>>
              <p class="card-text">Contact your college registrar or bursar’s office for assistance. </p>
              <div>
                <p class="card-text" style="display: <?php echo($position_id == 2 ? 'flex' : 'none'); ?>" >Please send transcripts for your highest completed degree.</p>
              </div>
              <a href="transcripts.php" class="btn btn-outline-lli btn-small mt-3">How to Send Transcripts</a>
          </div>
          <p class="doc_status" <?php echo(display_card_body_status($documents, 8)); ?>><?php echo(document_in_document_list($documents, 8)); ?></p>
          </div>
          <div class="card-footer c-card-7 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 9, $disposition)); ?>";>
          <div class="card-header c-card-8 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>8</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Schedule fingerprinting</h4>
            <div <?php echo(card_body_status($documents, 9)); ?>>
              <p class="card-text">Your fingerprinting will be paid for by Lifeline Youth & Family Services.</p>
              <a href="<?php echo url_for('/documents/Fingerprinting instructions.pdf'); ?>" target="_blank" class="btn btn-outline-lli btn-small mt-3">Instructions</a>
              </div>
              <p class="doc_status" <?php echo(display_card_body_status($documents, 9)); ?>><?php echo(document_in_document_list($documents, 9)); ?></p>
          </div>
          <div class="card-footer c-card-8 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
           </div>
        </div>
      </div>
      
      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 10, $disposition)); ?>";>
          <div class="card-header c-card-9 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>9</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">References</h4>
            <div <?php echo(card_body_status($documents, 10)); ?>>
            <p class="card-text">You will receive an email from Checkster to create an account and invite references to participate in your reference check.</p>
              <a href="references.php" class="btn btn-outline-lli btn-small mt-3">Instructions and Requirements</a>
              </div>
              <p class="doc_status" <?php echo(display_card_body_status($documents, 10)); ?>><?php echo(document_in_document_list($documents, 10)); ?></p>
          </div>
          <div class="card-footer c-card-9 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            </div>
        </div>
      </div>

    </div>
    <!-- /.row -->
    <div class="row text-center"> 

    <div class="col-lg-6 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 11, $disposition)); ?>";>
          <div class="card-header c-card-10 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>10</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Onboarding</h4>
            <div <?php echo(card_body_status($documents, 11)); ?>>
              <p class="card-text">You will receive an email from Lasting Change, Inc with a link to UKG. Please use this link to log in and complete the onboarding documents as soon as possible. This step must be completed before you may be onboarded as an employee.</p>
          </div>
          <p class="doc_status" <?php echo(display_card_body_status($documents, 11)); ?>><?php echo(document_in_document_list($documents, 11)); ?></p>
          </div>
          <div class="card-footer c-card-10 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 11, $disposition)); ?>";>
          <div class="card-header c-card-11 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            <h4>11</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Bio Sheet</h4>
            <div <?php echo(card_body_status($documents, 11)); ?>>
              <p class="card-text">Welcome to <?php echo $_SESSION['company'] ?>! To help us get to know you better, please complete the attached Bio Sheet, with some “Fun Facts”.  Also, please send a current picture, of yourself, to joinus@lastingchangeinc.org.</p>
              <p class="card-text">You have worked hard to get to this point and we are looking forward to meeting you in person.</p>
              <a href="<?php echo $bio ?>" target="_blank" class="btn btn-outline-lli btn-small mt-3">Bio Sheet Form</a>
          </div>
          <p class="doc_status" <?php echo(display_card_body_status($documents, 11)); ?>><?php echo(document_in_document_list($documents, 11)); ?></p>
          </div>
          <div class="card-footer c-card-11 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
          </div>
        </div>
      </div>
</div>
<div class="row text-center">
      <div class="col-lg-12 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 11, $disposition)); ?>";>
          <div class="card-header c-card-12 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>"><h4><?php echo ($ii_date > 0000-00-00 ? date("l, F j, Y", strtotime($ii_date)) : ''); ?></h4></div>
          <div class="card-body">
            <h4 class="card-title">Impact Institute</h4>
              
              <p class="card-text"><strong>We can’t wait to meet you!</strong></p>
              <p class="card-text">Your first week with us at Impact Institute will set you up to hit the ground running.</p>
            
            <div class="row text-left">
              <div class="col-lg-6" id="ii_testing">
                <h5>TB test, Drug Screen, Physical, and CPR Certification</h5>
                <p>All necessary medical screenings and CPR certification are covered by Lifeline and will take place during Impact Institute.</p>
                  
              </div>
              <div class="col-lg-6" id="ii_list">
                <h5>During Impact Institute you will:</h5>
                <ul>
                  <li>Meet the executives and leadership team</li>
                  <li>Learn about our mission, vision, and company culture</li>
                  <li>Experience a full week of preparation and training designed for your new role</li>
                  <li>Experience team-building with other new employees</li>
                  <li>Gain access to support from staff members, supervisors, and chaplains</li>
                </ul>
              </div>
            </div>
            <a href="<?php echo $ii; ?>" target="_blank" class="btn btn-outline-lli btn-small mt-3" <?php echo($company != 2 ? 'style="display: none;"' : ''); ?>">Learn more about your first week</a>
          </div>
          <div class="card-footer c-card-12 <?php echo(($company == 3 OR $company == 4) ? 'cw' : ''); ?>">
            
          </div>
        </div>
      </div>
  </div>
  <!-- /.row -->

  </div>
  <!-- /.container -->

  <?php include(SHARED_PATH . '/candidate_footer.php'); ?>  

  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>

   


</body>

</html>

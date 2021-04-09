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

$documents = documents_by_candidate($candidate_id);

$jd_doc_id_value = get_jd_doc_id($position_id);
$jd_doc_id = $jd_doc_id_value[0]['jd_doc_id'];
$templates = get_templates();


$jd = get_template_link($templates, $jd_doc_id);

$disc = get_template_link($templates, 4);

$page_title = 'Welcome to Lifeline';
include(SHARED_PATH . '/candidate_header.php'); ?>



  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron">
    <img src="<?php echo url_for('/images/LL New Hire_CandidateLandingPage 040921.jpg') ?>" alt="hero_img" style="width: 100%;">
      <!-- <h1 class="display-4">We cannot wait to get to know you better!</h1>
      <p class="lead">By applying with us, you have taken the first step to positively impact individuals, families, and communities. Below you will find an easy checklist to walk you through our hiring process.</p>
      <p class="lead">We ask that you complete the first four steps below within the next 48 hours so we can invite you to the panel interview and facilitate your onboarding experience. The speed with which you complete this process determines how quickly you can begin your work at Lifeline Youth & Family Services.</p>
      <p class="lead">As you move further along, you will receive emails from our HR representative, Jenn Falk (jenn.falk@lastingchangeinc.org), as well as KidTraks and Checkster. Please be sure to use the same email address on all forms and for all communication with Lifeline. Please reach out if you have any questions. We are happy to assist you in your hiring process, and we look forward to welcoming you to our team!</p> -->
    </header>
    
    <!-- Page Features -->
    <div class="row text-center">

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, $jd_doc_id)); ?>;">
          <div class="card-header c-card-1">
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
          <div class="card-footer c-card-1"></div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 4)); ?>;">
          <div class="card-header c-card-2">
            <h4>2</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Disclosure Form</h4>
            <div <?php echo(card_body_status($documents, 4)); ?>>
              <p class="card-text">First, Middle, and Last Name required! Please sign and date. </p>
              <p class="card-text">Note: Please use the same email used to sign in to this portal for SignNow.</p>
              <a href="<?php echo $disc; ?>" target="_blank" class="btn btn-outline-lli btn-small">FCRA Disclosure</a>
            </div>
            <p class="doc_status" <?php echo(display_card_body_status($documents, '4')); ?>><?php echo(document_in_document_list($documents, 4)); ?></p>
          </div>
          <div class="card-footer c-card-2">
           
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 5)); ?>;">
          <div class="card-header c-card-3">
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
          <div class="card-footer c-card-3">
            
          </div>
        </div>
      </div>

     
    </div>
    <!-- /.row -->

    <div class="row text-center">
      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 6)); ?>;">
          <div class="card-header c-card-4">
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
          <div class="card-footer c-card-4">
            
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 13)); ?>;">
          <div class="card-header c-card-5" >
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
          <div class="card-footer c-card-5">
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 7)); ?>;">
          <div class="card-header c-card-6">
            <h4>6</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Accept and sign the job offer</h4>
            <div <?php echo(card_body_status($documents, 7)); ?>>
              <p class="card-text" id="job-text">Please sign and return the official offer received in your email from joinus@lastingchangeinc.org so we can move you along to the next step!</p>
            </div>
            <p class="doc_status" <?php echo(display_card_body_status($documents, 7)); ?>><?php echo(document_in_document_list($documents, 7)); ?></p>
           </div>
          <div class="card-footer c-card-6">
            
          </div>
      </div>
      </div>

    </div>
    <!-- end row-->

    <div class="row text-center">
    <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display: <?php echo(box_visibility($documents, 8)); ?>";>
          <div class="card-header c-card-7">
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
          <div class="card-footer c-card-7">
            </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 9)); ?>";>
          <div class="card-header c-card-8">
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
          <div class="card-footer c-card-8">
           </div>
        </div>
      </div>
      
      <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 10)); ?>";>
          <div class="card-header c-card-9">
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
          <div class="card-footer c-card-9">
            </div>
        </div>
      </div>

    </div>
    <!-- /.row -->
    <div class="row text-center"> 

    <div class="col-lg-4 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 11)); ?>";>
          <div class="card-header c-card-10">
            <h4>10</h4>
          </div>
          <div class="card-body">
            <h4 class="card-title">Onboarding</h4>
            <div <?php echo(card_body_status($documents, 11)); ?>>
              <p class="card-text">You will receive an email from Lasting Change, Inc with a link to UKG. Please use this link to log in and complete the onboarding documents as soon as possible. This step must be completed before you may be onboarded as an employee.</p>
          </div>
          <p class="doc_status" <?php echo(display_card_body_status($documents, 11)); ?>><?php echo(document_in_document_list($documents, 11)); ?></p>
          </div>
          <div class="card-footer c-card-10">
          </div>
        </div>
      </div>

      <div class="col-lg-8 mb-4">
        <div class="card h-100" style="display:<?php echo(box_visibility($documents, 11)); ?>";>
          <div class="card-header c-card-11"><h4><?php echo ($ii_date > 0000-00-00 ? date("l, F j, Y", strtotime($ii_date)) : ''); ?></h4></div>
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
            <a href="<?php echo url_for('/documents/New Hires First Week.pdf'); ?>" target="_blank" class="btn btn-outline-lli btn-small mt-3">Learn more about your first week</a>
          </div>
          <div class="card-footer c-card-11">
            
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

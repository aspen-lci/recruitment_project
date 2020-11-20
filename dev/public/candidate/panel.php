<?php require_once('../../private/initialize.php'); 

$templates = get_templates();
$lea = get_template_link($templates, 5);

$candidate_set = get_candidate_by_user_id($_SESSION['user_id']);
$candidate = $candidate_set[0];
$zoom_link_set = get_zoom_link($candidate['region_id']);
$zoom_link = $zoom_link_set[0]['zoom_link'];

$page_title = 'Welcome to Lifeline';
include(SHARED_PATH . '/candidate_header.php'); ?>

  
    <!-- Page Content -->
    <div class="container" style="margin-top: 20px;">
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
      <!-- Jumbotron Header -->
      <header class="jumbotron my-4" style="background-color: rgba(242, 139, 48, .7);">
        <h1 class="text-center">Panel Interview</h1>
        <p class="lead"><b>Interview Date:</b> <?php echo (date("l, F d, Y", strtotime($candidate['interview_date']))); ?></p>
        <p class="lead"><b>Interview Time:</b> <?php echo (date("g:i A", strtotime($candidate['interview_time']))); ?></p>
        <a class="lead btn" id="logout-btn" href="<?php echo $zoom_link; ?>">Zoom Link</a>
        
      </header>
  
      <!-- Page Features -->
      <div class="row text-center">  
        <div class="col-lg-12 mb-4">
          <div class="card h-100">
            <div class="card-header" style="background-color: #F2E205;"><h3>Resources</h3></div>
            <div class="card-body">
              <div class="row text-justify">
                <div class="col-lg-12 d-flex justify-content-between">
                    <a class="lead btn" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/Zoom Etiquette - Candidate.pdf'); ?>">Zoom Etiquette</a>
                    <a class="lead btn" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/LL CareerPresentation 052220.pdf'); ?>">Lifeline Career Presentation</a>
                    <a class="lead btn" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FAQlist 2020.pdf'); ?>">FAQ List</a>
                    <a class="lead btn" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/Tenets of Culture Document.pdf'); ?>">Tenets of Our Culture</a>
                    <a class="lead btn" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FC Career Progression updated.pdf'); ?>" style="display: <?php echo($candidate['position'] == 1 ? "inherit" : "none"); ?>">Family Consultant Career Progression</a>
              </div>
              </div>
              
            </div>
            <div class="card-footer" style="background-color: #F2E205;">
              
            </div>
          </div>
        </div>

        <!-- <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-header" style="background-color: #0D0D0D;"></div>
            <div class="card-body">
              <h4 class="card-title">Form</h4>
                <a href="https://bit.ly/2SbHRzx" class="btn btn-outline-primary btn-small align-self-center mt-3" style="font-size: 1.25em;">LEA Criminal History and Background Check</a>
            </div>
            <div class="card-footer" style="background-color: #0D0D0D;"> -->
              
            <!-- </div>
          </div>
        </div> -->
    </div> 
    <!-- /.row -->
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
    </div>
    <!-- /.container -->
  
  <?php include(SHARED_PATH . '/candidate_footer.php'); ?>  
  </body>
  
  </html>
  
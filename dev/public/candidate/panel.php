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
    <div class="container" id="content" style="margin-top: 20px;">
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
      <!-- Jumbotron Header -->
      <header class="jumbotron" id="panel-img">
        <!-- <h1 class="text-center">Panel Interview</h1> -->
        <img src="<?php echo url_for('/images/LL New Hire_PanelInterview 0409214.jpg') ?>" alt="Panel Interview Information" style="width:100%;">
        <div class="top-right">
          <p><label class="panel-info">Interview Date:</label> <?php echo($candidate['interview_date'] > 0000-00-00 ? (date("l, F j, Y", strtotime($candidate['interview_date']))) : 'To Be Determined'); ?></p>
          <p><label class="panel-info">Interview Time:</label> <?php echo($candidate['interview_time'] > 0 ? (date("g:i A", strtotime($candidate['interview_time']))) : 'To Be Determined'); ?></p>
          <a class="lead btn" id="logout-btn" target="_blank" href="<?php echo $zoom_link; ?>">Zoom Link</a>
        </div>
      </header>
  
      <!-- Page Features -->
      <div class="row text-center">  
        <div class="col-lg-12 mb-4">
          <div class="card h-100">
            <div class="card-header c-card-5"><h3>Necessary Interview Materials</h3></div>
            <div class="card-body">
              <div class="row text-justify">
                <div class="col-lg-12 d-flex justify-content-center">
                    <a class="lead btn mr-2" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/Zoom Etiquette - Candidate.pdf'); ?>">Zoom Etiquette</a>
                    <a class="lead btn mr-2" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/LL CareerPresentation 052220.pdf'); ?>" style="display: <?php echo($candidate['company_id'] == '2' ? "inherit" : "none"); ?>">Lifeline Career Presentation</a>
                    <a class="lead btn mr-2" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FAQlist 2020.pdf'); ?>" style="display: <?php echo($candidate['company_id'] == '2' ? "inherit" : "none"); ?>">FAQ List</a>
                    <a class="lead btn mr-2" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/Tenets of Culture Document.pdf'); ?>">Tenets of Our Culture</a>
                    <a class="lead btn mr-2" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FC Career Progression updated.pdf'); ?>" style="display: <?php echo(($candidate['position_id'] == '1' OR $candidate['position_id'] == '5') ? "inherit" : "none"); ?>">Family Consultant Career Progression</a>
              </div>
              </div>
              
            </div>
            <div class="card-footer c-card-5">
              
            </div>
          </div>
        </div>

    </div> 
    <!-- /.row -->
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
    </div>
    <!-- /.container -->
  
  <?php include(SHARED_PATH . '/candidate_footer.php'); ?>  
  </body>
  
  </html>
  
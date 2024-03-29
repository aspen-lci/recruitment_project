<?php require_once('../../private/initialize.php'); 

$templates = get_templates();
$lea = get_template_link($templates, 5);
$position_id = get_position_id($_SESSION['user_id']);
$position = $position_id[0]['position_id'];

$page_title = 'Welcome to Lifeline';
include(SHARED_PATH . '/candidate_header.php'); ?>
  
    <!-- Page Content -->
    <div class="container" id="content" style="margin-top: 20px;">
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
      <!-- Jumbotron Header -->
      <header class="jumbotron">
      <img src="<?php echo url_for('/images/LL New Hire_Transcripts 0409215.jpg') ?>" alt="Transcript Instructions" style="width:100%;">  
      <!-- <h1>How to Send Transcripts</h1>
        <p class="lead">In order for DCS to qualify transcripts as official, they must be sent <strong>directly from the institution</strong> to jenn.falk@lastingchangeinc.org (preferred method) or they can mail them directly to our corporate office (4150 Illinois Road Fort Wayne, IN 46804, ATTN: Jenn Falk). <em>If transcripts are not sent from the institution, we cannot accept them as official.</em></p> -->
        
      </header>
  
      <div class="row text-center" style="display: <?php echo($position == '1' ? "inherit" : "none") ?>">  
        <div class="col-lg-12 mb-4">
          <div class="card h-100">
            <div class="card-header c-card-7"><h3>Required Degree Checklist</h3></div>
            <div class="card-body">
              <div class="row text-justify">
                <div class="col-lg-12 d-flex justify-content-between">
                    <a class="lead btn" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FC Degree Requirements.pdf'); ?>">Degree Requirements</a>
                    <a class="lead btn" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FC Degree Example.pdf'); ?>">Degree Requirements Worksheet Example</a>
                    <a class="lead btn" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FC Degree Form.pdf'); ?>">Degree Requirements Worksheet</a>
              </div>
              </div>
              
            </div>
            <div class="card-footer c-card-7">
              
            </div>
          </div>
        </div>

    </div> 
    <!-- /.row -->
    
<!-- Page Features -->
    <div class="row text-center" style="display: <?php echo ($_SESSION['position_id'] == 5 ? 'inherit' : 'none'); ?>">  
        <div class="col-lg-12 mb-4">
          <div class="card h-100">
            <div class="card-header c-card-7"><h3>Family Consultant Transcript Information</h3></div>
            <div class="card-body">
              <div class="row text-justify">
                <div class="col-lg-12 d-flex justify-content-center">
                <a class="lead btn mr-2" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FC Degree Requirements.pdf'); ?>">Family Consultant Degree Requirements</a>
                <a class="lead btn mr-2" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FC Degree Example.pdf'); ?>">Family Consultant Degree Examples</a>
                <a class="lead btn mr-2" target="_blank" id="logout-btn" href="<?php echo url_for('/documents/FC Degree Form.pdf'); ?>">Family Consultant Degree Form</a>
                    
              </div>
              </div>
              
            </div>
            <div class="card-footer c-card-7">
              
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
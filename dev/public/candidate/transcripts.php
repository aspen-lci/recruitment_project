<?php require_once('../../private/initialize.php'); 

$templates = get_templates();
$lea = get_template_link($templates, 5);

$page_title = 'Welcome to Lifeline';
include(SHARED_PATH . '/candidate_header.php'); ?>

  
    <!-- Page Content -->
    <div class="container" style="margin-top: 20px;">
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
      <!-- Jumbotron Header -->
      <header class="jumbotron my-4" style="background-color: rgba(242, 139, 48, .7);">
        <h1>How to Send Transcripts</h1>
        <p class="lead">In order for DCS to qualify transcripts as official, they must be sent <strong>directly from the institution</strong> to jenn.falk@lastingchangeinc.org (preferred method) or they can mail them directly to our corporate office (4150 Illinois Road Fort Wayne, IN 46804, ATTN: Jenn Falk). <em>If transcripts are not sent from the institution, we cannot accept them as official.</em></p>
        
      </header>
  
    
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
    </div>
    <!-- /.container -->
  
  <?php include(SHARED_PATH . '/candidate_footer.php'); ?>  
  </body>
  
  </html>
  
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
        <h1>Instructions</h1>
        <p class="lead">Please register online with Checkster. You will then be able to send invitations to colleagues and supervisors to fill out a reference form for you.</p>
        <h1>Requirements</h1>
        <p class="lead">A minimum of four (4) reference responses are required. Two (2) of these responses must be from current or past supervisors.</p>
        
      </header>
  
    
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
    </div>
    <!-- /.container -->
  
  <?php include(SHARED_PATH . '/candidate_footer.php'); ?>  
  </body>
  
  </html>
  
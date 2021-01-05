<?php require_once('../../private/initialize.php'); 

$templates = get_templates();
$lea = get_template_link($templates, 5);

$page_title = 'Welcome to Lifeline';
include(SHARED_PATH . '/candidate_header.php'); ?>

  
    <!-- Page Content -->
    <div class="container" style="margin-top: 20px;">
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
      <!-- Jumbotron Header -->
      <header class="jumbotron">
       <img src="<?php echo url_for('/images/LL New Hire_LEAform.jpg') ?>" alt="Instructions and Helpful Tips for Filling Out the LEA Form" style="width:100%;">
        <!-- <h1>Instructions and Helpful Tips for Filling Out the LEA Form</h1>
        <p class="lead">Please list all cities/counties/states resided in for the past five (5) years, <em>with dates</em> (month/day/year). Please see the following example.</p> -->
        
      </header>
  
      <!-- Page Features -->
      <div class="row text-center">  
        <div class="col-lg-12 mb-4">
          <div class="card h-100">
            <div class="card-header c-card-5"></div>
            <div class="card-body">
              <div class="row text-justify">
                <div class="col-lg-12">
                    <h3 class="text-center">Example</h3>
                <img src="<?php echo url_for('/images/LEA example.PNG'); ?>" alt="LEA example" style="width: 100%">
                <p class="text-center">I lived in Fort Wayne, IN until I went to college at Indiana University. After 2 years of college, I moved back to Fort Wayne, IN.</p>
                <p class="lead">Complete this form in its entirety, sign, and return.</p>
              </div>
              </div>
              <div class="row text-center">
              <div class="col-lg-12">
                <h4 class="text-center mt-3">Form</h4>
                <a href="<?php echo($lea); ?>" class="btn btn-outline-primary btn-small align-self-center mt-3" target="_blank" style="font-size: 1.25em;">LEA Criminal History and Background Check</a>      
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
  
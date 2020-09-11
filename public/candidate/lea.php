<?php require_once('../../private/initialize.php'); 



$page_title = 'Welcome to Lifeline';
include(SHARED_PATH . '/candidate_header.php'); ?>

  
    <!-- Page Content -->
    <div class="container" style="margin-top: 20px;">
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
      <!-- Jumbotron Header -->
      <header class="jumbotron my-4" style="background-color: rgba(242, 139, 48, .7);">
        <h1>Instructions and Helpful Tips for Filling Out the LEA Form</h1>
        <p class="lead">Must be completed for any county lived in over the past five (5) years. If you’ve lived in
            states other than Indiana within the past five (5) years, you may be provided additional documents.</p>
        <p class="lead">Should you have any questions, please contact HR at joinus@lastingchangeinc.org or your recruiter! We would be happy to assist you at any point in your hiring process.</p>
      </header>
  
      <!-- Page Features -->
      <div class="row text-center">  
        <div class="col-lg-12 mb-4">
          <div class="card h-100">
            <div class="card-header" style="background-color: #F20505;"></div>
            <div class="card-body">
              <div class="row text-justify">
                <div class="col-lg-12">
                    <h4 class="text-center">Example</h4>
                <img src="<?php echo url_for('/images/LEA example.PNG'); ?>" alt="LEA example" style="width: 100%">
                <p class="text-center">I lived in Fort Wayne, IN until I went to college at Indiana University. After 2 years of college, I moved back to Fort Wayne, IN.</p>
              </div>
              </div>
              <div class="row text-center">
              <div class="col-lg-12">
                <h4 class="text-center mt-3">Form</h4>
                <a href="https://bit.ly/2SbHRzx" class="btn btn-outline-primary btn-small align-self-center mt-3" style="font-size: 1.25em;">LEA Criminal History and Background Check</a>      
              </div>
            </div>
            </div>
            <div class="card-footer" style="background-color: #F20505;">
              
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
  
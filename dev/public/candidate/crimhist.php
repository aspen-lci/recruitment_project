<?php require_once('../../private/initialize.php'); 

$templates = get_templates();
$crim = get_template_link($templates, 6);

$page_title = 'Welcome to Lifeline';
include(SHARED_PATH . '/candidate_header.php'); ?>

    <!-- Page Content -->
    <div class="container" style="margin-top: 20px;">
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
      <!-- Jumbotron Header -->
      <header class="jumbotron">
        <img src="<?php echo url_for('/images/LL New Hire_CriminalBackgroundCheck.jpg'); ?>" alt="background_check_banner_img" style="width: 100%;">
        <!-- <h1 class="text-center">Instructions and Helpful Tips for Filling Out the Criminal History and Background Check Form</h1>
        <p class="lead mt-3">The Department of Child Services (DCS) requires the following information for your background check. Without this information, the hiring process cannot proceed.</p>
        <p class="lead">Please complete this form in its entirety, sign, and return. Keep an eye on your email over the next few days, for instructions regarding how the hiring process will continue. </p> -->
      </header>
  
      <!-- Page Features -->
      <div class="row text-center">  
        <div class="col-lg-12 mb-4">
          <div class="card h-100">
            <div class="card-header c-card-4"></div>
            <div class="card-body">
              <h4 class="card-title mb-4">HELPFUL HINTS: Common errors for criminal history form</h4>
              <div class="row text-left">
                  <div class="col-lg-12">
                  <ol>
                    <li>Your current address needs to include your street address – city, state, and zip code. </li>
                    <li>“Date moved to this address” needs to have the month, day, and year. </li>
                    <li>Section 2:
                      <ol type="a">
                        <li>Residency needs to include your city, state, and county (street address not required). </li>
                        <li>This section must be done in chronological order. <b>There may not be any gaps or overlap in your residential history.</b></li>
                        <li>You must list all residences dating back to January 1, 1988 or your birth date, whichever is MOST RECENT. Please see the following example.</li>
                        <li>If there is not enough space on this form for all addresses, please list additional addresses in a separate document and email to jenn.falk@lastingchangeinc.org.</li>
                      </ol>
                    </li>
                  </ol>
        
                    </div>
                </div>
            <div class="row text-center">  
                <div class="col-lg-12">
                    <h3 class="mt-4">Example</h3>
                    <img src="<?php echo url_for('/images/Criminal History.PNG') ?>" alt="Criminal Historoy Form Example" style="width: 100%;">
                    <p>(1) I was born 10/9/1990, I lived in my hometown Fort Wayne, IN until I went to college at (2) Indiana
                        University! I always went (3) home for the summer. (4) In August 2009, I transferred home to finish my
                        degree at IPFW and have lived in Fort Wayne since.</p>    
                </div>
                </div>
                <div class="row text-center">
                <div class="col-lg-12">
                
                    <p class="mt-4"><strong>Form</strong></p>
                    <a href="<?php echo $crim; ?>" target="_blank" class="btn btn-small align-self-center mt-3" id="logout-btn" style="font-size: 1.25em;">Criminal History and Background Check</a>
                </div>
            </div>
            </div>
            <div class="card-footer c-card-4">
              
            </div>
          </div>
        </div>
    </div>
    
    <a href="<?php echo url_for('/candidate/index.php'); ?>">&laquo; Return to Checklist</a>
    
    </div>
    <!-- /.container -->
  
    <?php include(SHARED_PATH . '/candidate_footer.php'); ?>  
  
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
    <script>
      // Add the following code if you want the name of the file appear on select
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
      </script>
  
  </body>
  
  </html>
  
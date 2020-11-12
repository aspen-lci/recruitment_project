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
        <h1 class="text-center">Instructions and Helpful Tips for Filling Out the Criminal History and Background Check Form</h1>
        <p class="lead mt-3">The Department of Child Services (DCS) requires the following information for your background check. Without this information, the hiring process cannot proceed.</p>
        <p class="lead">Please complete this form in its entirety, sign, and return. Keep an eye on your email over the next few days, for instructions regarding how the hiring process will continue. </p>
      </header>
  
      <!-- Page Features -->
      <div class="row text-center">  
        <div class="col-lg-12 mb-4">
          <div class="card h-100">
            <div class="card-header" style="background-color: #0D0D0D;"></div>
            <div class="card-body">
              <h4 class="card-title mb-4">HELPFUL HINTS: Common errors for criminal history form</h4>
              <div class="row text-justify">
                  <div class="col-lg-12">
                  <ol>
                    <li>Your current address needs to include your street address – city, state, and zip code. </li>
                    <li>“Date moved to this address” needs to have the month, day, and year. </li>
                    <li>Section 2:
                      <ol type="a">
                        <li>Residency needs to include your city, state, and county (street address not required). </li>
                        <li>This section must be done in chronological order. <b>There may not be any gaps or overlap in your residential history.</b></li>
                        <li>You must list all residences dating back to January 1, 1988 or your birth date, whichever is MOST RECENT. Please see the following example.</li>
                      </ol>
                    </li>
                  </ol>
        
                    </div>
                </div>
            <div class="row text-center">  
                <div class="col-lg-12">
                    <p class="mt-4"><strong>Example</strong></p>
                    <img src="<?php echo url_for('/images/Criminal History.PNG') ?>" alt="Criminal Historoy Form Example" style="width: 100%;">
                    <p>(1) I was born 10/9/1990, I lived in my hometown Fort Wayne, IN until I went to college at (2) Indiana
                        University! I always went (3) home for the summer. (4) In August 2009, I transferred home to finish my
                        degree at IPFW and have lived in Fort Wayne since.</p>    
                </div>
                </div>
                <div class="row text-center">
                <div class="col-lg-12">
                
                    <p class="mt-4"><strong>Form</strong></p>
                    <a href="https://bit.ly/2AmvMRg" class="btn btn-outline-primary btn-small align-self-center mt-3" style="font-size: 1.25em;">Criminal History and Background Check</a>
                </div>
            </div>
            </div>
            <div class="card-footer" style="background-color: #0D0D0D;">
              
            </div>
          </div>
        </div>
    </div>
    </div>
    <!-- /.container -->
  
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="text-white text-center"><strong>Individuals Succeed. Families Thrive. Communities Prosper.</strong></p>
        <p class="text-white text-center">4150 Illinois Road, Fort Wayne, IN 46804 | crosswinds.org | lastingchangestartshere.org | lifelineyouth.org</p>
        <p class="m-0 text-center text-white">Copyright &copy; Lifeline Youth and Family Services 2020</p>
      </div>
      <!-- /.container -->
    </footer>
  
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
  
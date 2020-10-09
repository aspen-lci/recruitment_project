<?php require_once('../../private/initialize.php'); 

$candidates = all_candidates();


?>



<?php $page_title = 'HR Dashboard'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>


    <!-- Page Content -->
      <div id="content">
          <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-dark text-center">Candidates In Process</h4>
                </div> <!-- Card header -->
                <div class="card-body"> 
                <div class="actions text-left mb-2"></div>
                <table
                id="parentTable"
                data-toggle="table"
                data-sortable="true"
                data-detail-view="true"
                data-pagination="true" 
                data-search="true" 
                data-show-toggle="true"
                data-detail-formatter="detailFormatter">
                
                <thead>
                <tr style="overflow-wrap:break-word;">
                    <th class="d-none">Hidden nested details table</th>
                    <th colspan="1"></th>
                    <th colspan="9" class="text-center">Documents Received</th>
                  </tr>
                  <tr>
                    
                    <th style data-sortable="true" data-field="name">Candidate Name</th>
                    <th style data-sortable="true" data-field="jobDesc">Job Description</th>
                    <th style data-sortable="true" data-field="discForm">Disclosure Form</th>
                    <th style data-sortable="true" data-field="lea">LEA</th>
                    <th style data-sortable="true" data-field="lCheck">Lifeline Background Check</th>
                    <th style data-sortable="true" data-field="jobOffer">Job Offer</th>
                    <th style data-sortable="true" data-field="trans">Transcripts</th>
                    <th style data-sortable="true" data-field="fPrint">Fingerprinting</th>
                    <th style data-sortable="true" data-field="ref">References</th>
                    <th style data-sortable="true" data-field="ultipro">Ultipro</th>
                    <th class="d-none"></th>
                  </tr>
                 
                </thead>
                <tbody>
                  <?php foreach($candidates as $candidate) { ?>
                  <tr data-has-detail-view="true">
                    <td><a class="action" href="<?php echo url_for('/hr/hr_candidates/edit.php?id=' . h($candidate['candidate_id'])); ?>"><?php echo ($candidate['first_name'] . " " . $candidate['last_name']); ?></a></td>
                    <td><a href="#">JobDescription.pdf</a></td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                  
                    <td class="detail-view" style="display:none;"> 
                    <table colspan="6" class="text-justify">  
                    <td style="border: none; padding-right: 50px;">
                        <dt>Email</dt>
                        <dd><?php echo $candidate['email']; ?></dd>
                        <dt>Recruiter</dt>
                        <dd><?php echo $candidate['recruiter']; ?></dd>
                    </td>
                    <td style="border: none; padding-right: 50px;">
                        <dt>Company</dt>
                        <dd><?php echo $candidate['company']; ?></dd>  
                        <dt>Position</dt>
                        <dd><?php echo $candidate['position']; ?></dd>
                    </td>
                    <td style="border: none; padding-right: 50px;">
                        <dt>Interview Date</dt>
                        <dd><?php echo $candidate['interview_date']; ?></dd>
                        <dt>Interview Time</dt>
                        <dd><?php echo $candidate['interview_time']; ?></dd>
                    </td>
                    <td style="border: none; padding-right: 50px;">
                        <dt>Start Date</dt>
                        <dd><?php echo $candidate['start_date']; ?></dd>
                        <dt>Impact Institute Date</dt>
                        <dd><?php echo $candidate['ii_date']; ?></dd>
                    </td>
                  </table>
                    </td>
                  </tr>

                  
                  <?php } ?>
                  
                </tbody>
              </table>
              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->
          </div> <!-- Content -->
    <?php include(SHARED_PATH . '/hr_footer.php'); ?>  
  
    <script>
      // Add the following code if you want the name of the file appear on select
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
      </script>

    <script>
      // Load detail view
          $('#parentTable').on('expand-row.bs.table', function (e, index, row, $detail) {

          // Get subtable from first cell
          var $rowDetails = $(row[10]);

          // Give new id to avoid conflict with first cell    
          var id = $rowDetails.attr("id");
          $rowDetails.attr("id", id + "-Show");

          // Write rowDetail to detail
          $detail.html($rowDetails);

          return;

          })
    </script>
    
    </body>
</html>

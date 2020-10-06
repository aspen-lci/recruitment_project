<?php require_once('../../private/initialize.php'); ?>

<?php
  $candidates = [
    ['id' => '1', 
    'name' => 'Angela Spencer', 
    'jobDesc' => '<a href="#">JobDescription.pdf</a>', 
    'discForm' => '<a href="#">Disclosure.pdf</a>',
    'lea' => '<a href="#">LEA.pdf</a>',
    'lCheck' => '<a href="#">LLBackground.pdf</a>',
    'jobOffer' => '<a href="#">JobOffer.pdf</a>',
    'trans' => '<i class="fas fa-check">',
    'fPrint' => '<i class="fas fa-check">',
    'ref' => '<i class="fas fa-check">',
    'ultipro' => '<i class="fas fa-check">',
    'startDate' => '09/12/2020',
    'position' => 'Developer',
    'email' => 'email@email.com'],

    ['id' => '2', 
    'name' => 'John Smith', 
    'jobDesc' => '<a href="#">JobDescription.pdf</a>', 
    'discForm' => '<a href="#">Disclosure.pdf</a>',
    'lea' => '<a href="#">LEA.pdf</a>',
    'lCheck' => '',
    'jobOffer' => '',
    'trans' => '',
    'fPrint' => '',
    'ref' => '',
    'ultipro' => '',
    'startDate' => '10/10/2020',
    'position' => 'Therapist',
    'email' => 'email@email.com'],

    ['id' => '3', 
    'name' => 'Jane Doe', 
    'jobDesc' => '<a href="#">JobDescription.pdf</a>', 
    'discForm' => '',
    'lea' => '',
    'lCheck' => '',
    'jobOffer' => '',
    'trans' => '',
    'fPrint' => '',
    'ref' => '',
    'ultipro' => '',
    'startDate' => '10/24/2020',
    'position' => 'Homemaker',
    'email' => 'email@email.com']

  ];
?>

<?php $page_title = 'Recruiter Dashboard'; ?>
<?php include(SHARED_PATH . '/recruiter_header.php'); ?>


    <!-- Page Content -->
    <div id="content">
      
          <div class="row text-center">
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-dark">Candidates In Process</h4>
                </div> <!-- Card header -->
                <div class="card-body"> 
                  <div class="actions text-left mb-2">
                  
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
                <tr>
                    <th class="d-none">Hidden nested details table</th>
                    <th colspan="1"></th>
                    <th colspan="9" class="text-center">Documents Received</th>
                  </tr>
                  <tr>
                    
                    <th style data-sortable="true" data-field="name">Candidate Name</th>
                    <!-- <th style data-sortable="true" data-field="startDate">Start Date</th>
                    <th style data-field="position">Position</th> -->
                    <th style data-field="jobDesc">Job Description</th>
                    <th style data-field="discForm">Disclosure Form</th>
                    <th style data-field="lea">LEA Background Check</th>
                    <th style data-field="lCheck">Lifeline Background Check</th>
                    <th style data-field="jobOffer">Job Offer</th>
                    <th style data-field="trans">Transcripts</th>
                    <th style data-field="fPrint">Fingerprinting</th>
                    <th style data-field="ref">References</th>
                    <th style data-field="ultipro">Ultipro</th>
                    <th class="d-none"></th>
                  </tr>
                 
                </thead>
                <tbody>
                  <?php foreach($candidates as $candidate) { ?>
                  <tr data-has-detail-view="true">
                    <td><a class="action" href="<?php echo url_for('/hr/hr_candidates/show.php?id=' . h($candidate['id'])); ?>"><?php echo $candidate['name']; ?></a></td>
                    <!-- <td>09/12/2020</td>
                    <td>Developer</td> -->
                    <td><?php echo $candidate['jobDesc']; ?></td>
                    <td><?php echo $candidate['discForm']; ?></td>
                    <td><?php echo $candidate['lea']; ?></td>
                    <td><?php echo $candidate['lCheck']; ?></td>
                    <td><?php echo $candidate['jobOffer']; ?></td>
                    <td><?php echo $candidate['trans']; ?></td>
                    <td><?php echo $candidate['fPrint']; ?></td>
                    <td><?php echo $candidate['ref']; ?></td>
                    <td><?php echo $candidate['ultipro']; ?></td>
                  
                    <td class="detail-view"> 
                      <dl class="text-justify">
                        <dt>Start Date</dt>
                        <dd><?php echo $candidate['startDate']; ?></dd>
                        <dt>Position</dt>
                        <dd><?php echo $candidate['position']; ?></dd>
                        <dt>Email</dt>
                        <dd><?php echo $candidate['email']; ?></dd>
                      </dl>
                    </td>
                  </tr>

                  
                  <?php } ?>
                  
                </tbody>
              </table>
              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->
            </div>
            </div>

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

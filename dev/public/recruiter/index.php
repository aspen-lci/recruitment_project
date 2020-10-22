<?php require_once('../../private/initialize.php'); 

/**
 * Object to encapsulate document status logic.
 */
class Documents {
    // map of valid document keys and associated descriptions
    public static $docMap = [
        "jobDesc" => "Job Description",
        "discForm" => "Disclosure",
        "lea" => "LEA",
        "lCheck" => "Background Check",
        "jobOffer" => "Job Offer",
        "trans" => "Transcripts",
        "fPrint" => "Fingerprinting",
        "ref" => "Reference Check",
        "ultipro" => "Ultipro Onboarding"
    ];

    private $reqProps = ["id"=>0, "status"=>"", "signed_link"=>""];

    private $docList = [];

    public function __construct($json = false) {
        if ($json) $this->addAll(json_decode($json));            
    }

    /**
     * Add list of documents.
     * 
     * @param $docs array of objects to add
     */
    public function addAll($docs) {
        if (!empty($docs)) {
          if(!is_array($docs)) $docs = [$docs];
          
          $keys = [];
          foreach($docs as $doc) {
            $key = $this->add($doc);
            if ($key) $keys[] = $key;
          }
          if (!empty($keys)) return $keys;
        }

        return false;
    }

    /**
     * Add an individual document.
     * 
     * @param $doc object document object to add
     */
    public function add($doc) {
        if (!empty($doc) && is_object($doc) && $doc !== null) {
          $key = false;

          // set key as JD if flagged as a job description doc.
          if (property_exists($doc, "is_jd") && $doc->is_jd == 1) {
              $key = "jobDesc";
          } 
          
          // if key not set, try description via document map lookup.
          if (false === $key && property_exists($doc, "description")) {
              $key = array_search($doc->description, Documents::$docMap);
              if (false === $key) $key = $doc->description;
          }
  
          // once key is set, add document object by key.
          if ($key) {
              // cleanup document object required properties
              foreach(array_keys($this->reqProps) as $prop) {
                  if (!property_exists($doc, $prop) || $doc->{$prop} === null) $doc->{$prop} = $this->reqProps[$prop];
              }
              $this->docList[$key] = $doc;
          }

          return $key;
        }        

        return false;
    }

    /**
     * Get individual document.
     * 
     * @param $docKey string
     * returns object of document specified by docKey
     */
    public function get(string $docKey) {
        if (array_key_exists($docKey, $this->docList)) return $this->docList[$docKey];
        return (object) $this->reqProps;
    }

    /**
     * Get all documents in map.
     * if documnet list is empty, will return list of objects with default required property values.
     */
    public function getAll() {
      $docs = [];
      foreach(array_keys(Documents::$docMap) as $key) {
        $docs[$key] = $this->get($key);
      }
      return $docs;
    }
}
  
$candidates = candidates_by_recruiter((!isset($_SESSION['user_id'])) ? 15 : $_SESSION['user_id']);

?>

<?php $page_title = 'Recruiter Dashboard'; ?>
<?php include(SHARED_PATH . '/recruiter_header.php'); ?>


    <!-- Page Content -->
    <div id="content">
      
          <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-dark text-center">Candidates In Process</h4>
                </div> <!-- Card header -->
                <div class="card-body"> 
                  <div class="actions text-left mb-2">
                  
                <table
                id="parentTable"
                data-toggle="table"
                data-sortable="true"
                data-detail-view="true"
                data-detail-view-icon="true"
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
                    <?php foreach(Documents::$docMap as $k=>$v) echo sprintf('<th style data-sortable="true" data-field="%s">%s</th>', $k, $v); ?>
                    <th class="d-none"></th>
                  </tr>
                 
                </thead>
                <tbody>
                  <?php foreach($candidates as $candidate) { $docs = new Documents($candidate['documents']); ?>
                  <tr data-has-detail-view="true">
                    <td><a class="action" href="<?php echo url_for('/recruiter/edit.php?id=' . h($candidate['candidate_id'])); ?>"><?php echo (h($candidate['first_name']) . ' ' . h($candidate['last_name'])); ?></a></td>
                    <?php foreach($docs->getAll() as $d) echo sprintf('<td class="text-center">%s</td>', $d->status); ?>                
                  
                    <td class="detail-view" style="display:none;"> 
                    <table colspan="6" class="text-justify">  
                    <td style="border: none; padding-right: 50px;">
                        <dt>Email</dt>
                        <dd><?php echo $candidate['email'] ?? ''; ?></dd>
                        <dt>Recruiter</dt>
                        <dd><?php echo $candidate['recruiter'] ?? ''; ?></dd>
                    </td>
                    <td style="border: none; padding-right: 50px;">
                        <dt>Company</dt>
                        <dd><?php echo $candidate['company'] ?? ''; ?></dd>  
                        <dt>Position</dt>
                        <dd><?php echo $candidate['position'] ?? ''; ?></dd>
                    </td>
                    <td style="border: none; padding-right: 50px;">
                        <dt>Interview Date</dt>
                        <dd><?php echo $candidate['interview_date'] ?? ''; ?></dd>
                        <dt>Interview Time</dt>
                        <dd><?php echo $candidate['interview_time'] ?? ''; ?></dd>
                    </td>
                    <td style="border: none; padding-right: 50px;">
                        <dt>Start Date</dt>
                        <dd><?php echo $candidate['start_date'] ?? ''; ?></dd>
                        <dt>Impact Institute Date</dt>
                        <dd><?php echo $candidate['ii_date'] ?? ''; ?></dd>
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
          var $id = $rowDetails.attr("id");
          $rowDetails.attr("id", $id + "-Show");

          // Write rowDetail to detail
          $detail.html($rowDetails);

          return;

          })
    </script>
    
    </body>
</html>

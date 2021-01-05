<?php require_once('../../private/initialize.php');  

$page_title = 'Admin Dashboard';
include(SHARED_PATH . '/admin_header.php');

$companies = all_companies();
$documents = all_documents();
$ii_dates = all_ii_dates();
$positions = all_positions();
$districts = all_regions();
$dispositions = all_dispositions();
$doc_statuses = all_doc_status();

?>
<a id="top"></a>
<div class="row" id="admin_btn_group">
    <div class="m-auto">
      <a class="btn btn-admin d-inline" type="button" href="#">Companies</a>
      <a class="btn btn-admin d-inline" type="button" href="#documents">Documents</a>
      <a class="btn btn-admin d-inline" type="button" href="#ii_dates">Impact Institute Dates</a>
      <a class="btn btn-admin d-inline" type="button" href="#positions">Positions</a>
      <a class="btn btn-admin d-inline" type="button" href="#districts">Districts</a>
      <a class="btn btn-admin d-inline" type="button" href="#dispositions">Dispositions</a>
      <a class="btn btn-admin d-inline" type="button" href="#doc_status">Document Statuses</a>
      <a class="btn btn-admin d-inline" type="button" href="#sql">SQL</a>
    </div>
</div>

    <div class="row text-center">
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex">
                  <a class="btn p-2" type="button" href="<?php echo(url_for('/admin/new_company.php')); ?>">Add New Company</a>
                  <h3 class="m-auto font-weight-bold text-light">Companies</h3>
                </div> <!-- Card header -->
            
            <div class="card-body"> 
                <table
                id="table"
                data-toggle="table"
                data-sortable="true"
                data-pagination="false" 
                data-search="true">
                <thead>
                  <tr>
                    <th style data-sortable="true" data-searchable="true" data-field="name">Company Name</th>
                    <th style data-sortable="true" data-searchable="true" data-field="email">Logo URL</th>
                    <th style>Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($companies as $company) { ?>
                  <tr>
                    <td><?php echo h($company['company']); ?></td>
                    <td><?php echo h($company['logo_url']); ?></td>
                    
                    <td>
                    <a href="<?php echo(url_for('/admin/edit_company.php?id=' . $company['id'])); ?>"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>

              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->

            <a id="documents"></a>
        <div class="row text-center">
            <div class="col-lg-12 mb-4">
                <a href="#top">Return to Top</a>
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex">
                    <a class="btn p-2" type="button" href="<?php echo(url_for('/admin/new_document.php')); ?>">Add New Document</a>
                    <h3 class="m-auto font-weight-bold text-light">Documents</h3>
                </div> <!-- Card header -->
            
            <div class="card-body"> 
                <table
                id="table"
                data-toggle="table"
                data-sortable="true"
                data-pagination="false" 
                data-search="true">
                <thead>
                  <tr>
                    <th style data-sortable="true" data-searchable="true">ID</th>
                    <th style data-sortable="true" data-searchable="true">Description</th>
                    <th style data-sortable="true" data-searchable="true">Job Description</th>
                    <th style data-sortable="true" data-searchable="true">Template Link</th>
                    <th style></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($documents as $document) { ?>
                  <tr>
                    <td><?php echo h($document['id']); ?></td>
                    <td><?php echo h($document['description']); ?></td>
                    <td><i class="fas fa-check" style="display:<?php echo ($document['is_jd'] == '1' ? "initial" : "none"); ?>"></i></td>
                    <td><?php echo h($document['template_link']); ?></td>
                    <td>
                    <a href="<?php echo(url_for('/admin/edit_documents.php?id=' . $document['id'])); ?>"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>

              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->

            <a id="ii_dates"></a>
            <div class="row text-center">
            <div class="col-lg-12 mb-4">
            <a href="#top">Return to Top</a>
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex">
                  <a class="btn p-2" type="button" href="#">Add New Date</a>
                  <h3 class="m-auto font-weight-bold text-light">Impact Institute Dates</h3>
                </div> <!-- Card header -->
            
            <div class="card-body"> 
                <table
                id="table"
                data-toggle="table"
                data-sortable="true"
                data-pagination="false" 
                data-search="true">
                <thead>
                  <tr>
                    <th style data-sortable="true" data-searchable="true">ID</th>
                    <th style data-sortable="true" data-searchable="true">Date</th>
                    <th style data-sortable="true">Inactive</th>
                    <th style>Make Inactive</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($ii_dates as $date) { ?>
                  <tr>
                    <td><?php echo h($date['id']); ?></td>
                    <td>
                      <?php 
                      $change_date = convert_date($date['date']); 
                      echo $change_date;
                      ?>
                      </td>
                    <td><i class="fas fa-check" style="display:<?php echo ($date['inactive'] == '1' ? "initial" : "none"); ?>"></i></td>
                    <td class="d-flex justify-content-center">
                        <form action="<?php echo url_for('/admin/index.php?id=' . h(u($user['user_id'])) . '&inactive=' . $user['inactive'] . '&role=' . $user['role_id']); ?>" method="post">
                            <button type="submit" class="btn" value="submit">Change Status</button>
                        </form>
                    </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>

              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->

            <a id="positions"></a>
            <div class="row text-center">
            <div class="col-lg-12 mb-4">
            <a href="#top">Return to Top</a>
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex">
                  <a class="btn p-2" type="button" href="#">Add New Position</a>
                  <h3 class="m-auto font-weight-bold text-light">Positions</h3>
                </div> <!-- Card header -->
            
            <div class="card-body"> 
                <table
                id="table"
                data-toggle="table"
                data-sortable="true"
                data-pagination="false" 
                data-search="true">
                <thead>
                  <tr>
                    <th style data-sortable="true" data-searchable="true">ID</th>
                    <th style data-sortable="true" data-searchable="true">Title</th>
                    <th style data-sortable="true" data-searchable="true">Company ID</th>
                    <th style data-sortable="true" data-searchable="true">Job Description ID</th>
                    <th style></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($positions as $position) { ?>
                  <tr>
                    <td><?php echo h($position['id']); ?></td>
                    <td><?php echo h($position['title']); ?></td>
                    <td><?php echo h($position['company_id']); ?></td>
                    <td><?php echo h($position['jd_doc_id']); ?></td>
                    <td>
                        <div class="dropdown d-inline-block">
                        <a type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                          <div class="dropdown-menu dropdown-primary">
                          <form  action="<?php echo url_for('/hr/hr_users/index.php?id=' . h(u($user['user_id'])) . '&inactive=' . $user['inactive'] . '&role=' . $user['role_id']); ?>" method="post">
                            <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Change Status</button>
                          </form>
                        
                      <form onsubmit="return confirm('<?php echo('Would you like to reset the password for ' . h($user['first_name']) . ' ' . h($user['last_name']) . '?'); ?>')" action="<?php echo url_for('/hr/hr_users/delete.php?id=' . h(u($user['user_id']))); ?>" method="post">
                        <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Reset Password</button>
                      </form>

                      

                      </div>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>

              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->

            <a id="districts"></a>
            <div class="row text-center">
            <div class="col-lg-12 mb-4">
            <a href="#top">Return to Top</a>
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex">
                  <a class="btn p-2" type="button" href="#">Add New District</a>
                  <h3 class="m-auto font-weight-bold text-light">Districts</h3>
                </div> <!-- Card header -->
            
            <div class="card-body"> 
                <table
                id="table"
                data-toggle="table"
                data-sortable="true"
                data-pagination="false" 
                data-search="true">
                <thead>
                  <tr>
                    <th style data-sortable="true" data-searchable="true">ID</th>
                    <th style data-sortable="true" data-searchable="true">District Name</th>
                    <th style data-sortable="true" data-searchable="true">Zoom Link</th>
                    <th style></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($districts as $district) { ?>
                  <tr>
                    <td><?php echo h($district['id']); ?></td>
                    <td><?php echo h($district['name']); ?></td>
                    <td><?php echo h($district['zoom_link']); ?></td>
                    <td>
                        <div class="dropdown d-inline-block">
                        <a type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                          <div class="dropdown-menu dropdown-primary">
                          <form  action="<?php echo url_for('/hr/hr_users/index.php?id=' . h(u($user['user_id'])) . '&inactive=' . $user['inactive'] . '&role=' . $user['role_id']); ?>" method="post">
                            <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Change Status</button>
                          </form>
                        
                      <form onsubmit="return confirm('<?php echo('Would you like to reset the password for ' . h($user['first_name']) . ' ' . h($user['last_name']) . '?'); ?>')" action="<?php echo url_for('/hr/hr_users/delete.php?id=' . h(u($user['user_id']))); ?>" method="post">
                        <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Reset Password</button>
                      </form>

                      

                      </div>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>

              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->

            <a id="dispositions"></a>
            <div class="row text-center">
            <div class="col-lg-12 mb-4">
            <a href="#top">Return to Top</a>
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex">
                  <a class="btn p-2" type="button" href="#">Add New Disposition</a>
                  <h3 class="m-auto font-weight-bold text-light">Dispositions</h3>
                </div> <!-- Card header -->
            
            <div class="card-body"> 
                <table
                id="table"
                data-toggle="table"
                data-sortable="true"
                data-pagination="false" 
                data-search="true">
                <thead>
                  <tr>
                    <th style data-sortable="true" data-searchable="true">ID</th>
                    <th style data-sortable="true" data-searchable="true">Disposition</th>
                    <th style></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dispositions as $disposition) { ?>
                  <tr>
                    <td><?php echo h($disposition['status_id']); ?></td>
                    <td><?php echo h($disposition['status']); ?></td>
                    <td>
                        <div class="dropdown d-inline-block">
                        <a type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                          <div class="dropdown-menu dropdown-primary">
                          <form  action="<?php echo url_for('/hr/hr_users/index.php?id=' . h(u($user['user_id'])) . '&inactive=' . $user['inactive'] . '&role=' . $user['role_id']); ?>" method="post">
                            <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Change Status</button>
                          </form>
                        
                      <form onsubmit="return confirm('<?php echo('Would you like to reset the password for ' . h($user['first_name']) . ' ' . h($user['last_name']) . '?'); ?>')" action="<?php echo url_for('/hr/hr_users/delete.php?id=' . h(u($user['user_id']))); ?>" method="post">
                        <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Reset Password</button>
                      </form>

                      

                      </div>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>

              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->

            <a id="doc_status"></a>
            <div class="row text-center">
            <div class="col-lg-12 mb-4">
            <a href="#top">Return to Top</a>
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex">
                  <a class="btn p-2" type="button" href="#">Add New Document Status</a>
                  <h3 class="m-auto font-weight-bold text-light">Document Statuses</h3>
                </div> <!-- Card header -->
            
            <div class="card-body"> 
                <table
                id="table"
                data-toggle="table"
                data-sortable="true"
                data-pagination="false" 
                data-search="true">
                <thead>
                  <tr>
                    <th style data-sortable="true" data-searchable="true">ID</th>
                    <th style data-sortable="true" data-searchable="true">Status</th>
                    <th style></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($doc_statuses as $doc_status) { ?>
                  <tr>
                    <td><?php echo h($doc_status['status_id']); ?></td>
                    <td><?php echo h($doc_status['status']); ?></td>
                    <td>
                        <div class="dropdown d-inline-block">
                        <a type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                          <div class="dropdown-menu dropdown-primary">
                          <form  action="<?php echo url_for('/hr/hr_users/index.php?id=' . h(u($user['user_id'])) . '&inactive=' . $user['inactive'] . '&role=' . $user['role_id']); ?>" method="post">
                            <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Change Status</button>
                          </form>
                        
                      <form onsubmit="return confirm('<?php echo('Would you like to reset the password for ' . h($user['first_name']) . ' ' . h($user['last_name']) . '?'); ?>')" action="<?php echo url_for('/hr/hr_users/delete.php?id=' . h(u($user['user_id']))); ?>" method="post">
                        <button type="submit" class="dropdown-item btn btn-dropdown" value="submit">Reset Password</button>
                      </form>

                      

                      </div>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>

              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->

            <a id="sql"></a>
            <div class="row text-center">
            <div class="col-lg-12 mb-4">
            <a href="#top">Return to Top</a>
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h3 class="mr-auto font-weight-bold text-light">SQL Input</h3>
                </div> <!-- Card header -->
            
            <div class="card-body"> 
            <form id="sql">   
                <textarea rows="10" cols="200"></textarea>
                <button class="btn" form="sql" type="submit">Submit</button>
            </form>
                
              </div> <!-- end card body -->
            </div> <!-- Card -->
            </div> <!-- Column -->
            </div> <!-- Row -->

<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
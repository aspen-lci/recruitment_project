<?php require_once('../../private/initialize.php');  

$page_title = 'Admin Dashboard';
include(SHARED_PATH . '/admin_header.php');

if (is_post_request()){
    $company['company'] = $_POST['name'];
    $company['logo_url'] = $_POST['url'];

    $create = create_company($company);


    if($create == true){
        $_SESSION['message'] = "Company created.";
        redirect_to(url_for('/admin/index.php'));    
    }else{
        $errors = $update;
        redirect_to(url_for('/admin/new_company.php'))
    }
   

}

?>

<div id="content">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form class="form-group" id="company_edit" action="<?php echo url_for('/admin/edit_company.php?id=' . $id); ?>" method="post">
                        <div class="row m-3">
                            <label for="name">Company name</label>
                            <input id="name" class="form-control" type="text" name="name" value="<?php echo $company[0]['company']; ?>">
                        </div>
                        <div class="row m-3">
                            <label for="url">Logo URL</label>
                            <input id="url" class="form-control" type="text" name="url" value="<?php echo $company[0]['logo_url']; ?>">
                        </div>
                        <button form="company_edit" type="submit" class="btn">Update</button>
                    </form>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end column -->
    </div> <!-- end row -->


</div> <!-- end content -->









<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
<?php require_once('../../private/initialize.php');  

$page_title = 'Admin Dashboard';
include(SHARED_PATH . '/admin_header.php');

if (is_post_request()){
    $document['description'] = $_POST['description'];
    $document['is_jd'] = $_POST['is_jd'];
    $document['template_link'] = $_POST['template_link'];

    $create = create_document($document);


    if($create == true){
        $_SESSION['message'] = "Document created.";
        redirect_to(url_for('/admin/index.php'));    
    }else{
        $errors = $update;
        
    }
   
}

?>

<div id="content">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form class="form-group" id="new_document" action="<?php echo url_for('/admin/new_document.php'); ?>" method="post">
                        <div class="row m-3">
                            <label for="description">Description</label>
                            <input id="description" class="form-control" type="text" name="description" value="<?php echo(isset($document[0]['description']) ? $document[0]['description'] : ""); ?>">
                        </div>
                        <div class="row m-3">
                            <label for="is_jd">Job Description</label>
                            <select name="is_jd" id="id_jd" class="form-control">
                                <option id="is_jd" class="form-control" name="is_jd" value=0 <?php echo(isset($document[0]['template_link']) && ($document[0]['template_link'] === 0) ? 'selected': ""); ?>>No</option>
                                <option id="is_jd" class="form-control" name="is_jd" value=1 <?php echo(isset($document[0]['template_link']) && ($document[0]['template_link'] === 1) ? 'selected': ""); ?>>Yes</option>
                            </select>
                        </div>
                        <div class="row m-3">
                            <label for="template_link">Template Link</label>
                            <input id="template_link" class="form-control" type="text" name="template_link" value="<?php echo(isset($document[0]['template_link']) ? $document[0]['template_link'] : ""); ?>">
                        </div>
                        <button form="new_document" type="submit" class="btn">Create New Document</button>
                    </form>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end column -->
    </div> <!-- end row -->


</div> <!-- end content -->









<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
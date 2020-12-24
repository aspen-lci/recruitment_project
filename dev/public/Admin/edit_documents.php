<?php require_once('../../private/initialize.php');  

$page_title = 'Admin Dashboard';
include(SHARED_PATH . '/admin_header.php');

$id = $_GET['id'];

if (is_get_request()){

$document = get_document_by_id($id);

}

if (is_post_request()){
    $document_update['description'] = $_POST['description'];
    $document_update['is_jd'] = $_POST['is_jd'];
    $document_update['template_link'] = $_POST['template_link'];
    $document_update['id'] = $id;

    $update = update_document($document_update);


    if($update == true){
        $_SESSION['message'] = "Document updated.";
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
                    <form class="form-group" id="document_edit" action="<?php echo url_for('/admin/edit_documents.php?id=' . $id); ?>" method="post">
                        <div class="row m-3">
                            <label for="description">Description</label>
                            <input id="description" class="form-control" type="text" name="description" value="<?php echo $document[0]['description']; ?>">
                        </div>
                        <div class="row m-3">
                            <label for="is_jd">Job Description</label>
                            <select class="form-control" name="is_jd" id="is_jd">
                                <option name="is_jd" value="0" <?php echo($document[0]['is_jd'] == 0 ? 'selected' : ""); ?>>No</option>
                                <option name="is_jd" value="1" <?php echo($document[0]['is_jd'] == 1 ? 'selected' : ""); ?>>Yes</option>
                            </select>
                        </div>
                        <div class="row m-3">
                            <label for="template_link">Template Link</label>
                            <input id="template_link" class="form-control" type="text" name="template_link" value="<?php echo $document[0]['template_link']; ?>">
                        </div>
                        <button form="document_edit" type="submit" class="btn">Update</button>
                    </form>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end column -->
    </div> <!-- end row -->


</div> <!-- end content -->









<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
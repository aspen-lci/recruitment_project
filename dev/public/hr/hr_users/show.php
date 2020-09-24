<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'HR Dashboard'; ?>
<?php include(SHARED_PATH . '/hr_header.php'); ?>

<?php

    $id = $_GET['id'] ?? '1';
    // 'name' => 'Angela Spencer', 
    // 'jobDesc' => '<a href="#">JobDescription.pdf</a>', 
    // 'discForm' => '<a href="#">Disclosure.pdf</a>',
    // 'lea' => '<a href="#">LEA.pdf</a>',
    // 'lCheck' => '<a href="#">LLBackground.pdf</a>',
    // 'jobOffer' => '<a href="#">JobOffer.pdf</a>',
    // 'trans' => '<i class="fas fa-check">',
    // 'fPrint' => '<i class="fas fa-check">',
    // 'ref' => '<i class="fas fa-check">',
    // 'ultipro' => '<i class="fas fa-check">',
    // 'startDate' => '09/12/2020',
    // 'position'

    
?>
<div id="content">
<a class="back-link" href="<?php echo url_for('/hr/hr_users/index.php'); ?>">&laquo; Back to List</a>
    <div>
    User ID: <?php echo h($id); ?>
    </div>
</div>


<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
<?php require_once('../../private/initialize.php'); 
$candidate = get_candidate_by_id('5');
print_r($candidate);
echo ($candidate['first_name']);

?>


<?php $page_title = 'Recruiter Dashboard'; ?>
<?php include(SHARED_PATH . '/recruiter_header.php'); ?>

<h3><?php echo (h($candidate['first_name']) . ' ' . h($candidate['last_name'])); ?></h3>

<?php include(SHARED_PATH . '/hr_footer.php'); ?>  
</body>
</html>
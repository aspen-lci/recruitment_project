<?php 
    if(!isset($page_title)) { $page_title = 'New Hire';}

    if(!isset($_GET['co'])){
      $_SESSION['logo'] = '';
    }else{
      if($_GET['co'] == 'll'){
        $_SESSION['logo'] = url_for('/images/LLlogo.png');
      }elseif($_GET['co'] = 'cw'){
        $_SESSION['logo'] = url_for('/images/Crosswinds-715c.png');
      }else{
        $_SESSION['logo'] = '';
      }
    }

    if(isset($_SESSION['company_id'])){
      if($_SESSION['company_id'] == '2'){
        $_SESSION['logo'] = url_for('/images/LLlogo.png');
      }elseif($_SESSION['company_id'] == '3'){
        $_SESSION['logo'] = url_for('/images/Crosswinds-715c.png');
      }else{
        $_SESSION['logo'] = '';
      }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Lifeline Onboarding - <?php echo $page_title; ?></title>

  <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo url_for('/images/apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo url_for('/images/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo url_for('/images/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo url_for('/images/site.webmanifest'); ?>">

  <!-- Bootstrap core CSS -->
  <link href="<?php echo url_for('/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo url_for('/css/heroic-features.css') ?>" rel="stylesheet">

  <!-- My Custom Styles-->
  <link href="<?php echo url_for('/css/custom.css') ?>" rel="stylesheet">

</head>

<body id="total-body" style="overflow: hidden;">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="margin-bottom: 20px;">
    <div class="container">
      <div id="logo">
        <!-- <a class="navbar-brand" href="#" <?php echo($_SESSION['logo'] == '' ? 'style="display:none;"' : ''); ?>><img src="<?php echo $_SESSION['logo']; ?>" alt="Logo" style="height: 100px;"></a> -->
        <a class="navbar-brand" href="#"><img src="<?php echo(url_for('/images/Lasting-Change-715c.png')) ?>" alt="Logo" style="height: 100px;"></a>
      </div>

     <div id="welcome">
      <p><?php echo (empty($_SESSION['first_name'])) ? 'Welcome!' : 'Welcome, ' . $_SESSION['first_name'] . '!'; ?></p>
    </div>
      <navigation>   
        <ul>
          <li><a href="<?php echo url_for('/logout.php'); ?>" class="btn" id="logout-btn" role="button">Log Out</a></li>

    </div>
  </nav>
  <?php echo display_session_message(); ?>
  <?php echo display_errors($errors); ?>
  
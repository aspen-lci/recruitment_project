<?php 
    if(!isset($page_title)) { $page_title = 'New Hire';}
    require_login();
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
  <link href="<?php echo url_for('/css/cards.css') ?>" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <div id="logo">
        <a class="navbar-brand" href="#"><img src="<?php echo url_for('/images/LLlogo.png') ?>" alt="Logo" style="height: 100px;"></a>
      </div>

     <div id="welcome">
      <p><?php echo (empty($_SESSION['first_name'])) ? 'Welcome!' : 'Welcome, ' . $_SESSION['first_name'] . '!'; ?></p>
    </div>
      <navigation>   
        <ul>
        <!-- <li style="list-style-type: none;"><a href="<?php echo url_for('/logout.php'); ?>" class="btn" id="logout-btn" role="button">Log Out</a></li> -->
        <li class="nav-item">
              <a href="<?php echo url_for('/logout.php'); ?>" class="nav-link btn" id="logout-btn" role="button">Log Out</a>
            </li>
      
      <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div> -->
    </div>
  </nav>
  <?php echo display_session_message(); ?>
  <?php echo display_errors($errors); ?>
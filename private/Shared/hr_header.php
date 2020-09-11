<?php 
    if(!isset($page_title)) { $page_title = 'HR';}
?>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lifeline Onboarding - <?php echo $page_title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo url_for('/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4071952ce3.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo url_for('/css/heroic-features.css'); ?>" rel="stylesheet">

    <!-- Bootstrap Table -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
  
    <!-- X-editable -->
    <link rel="stylesheet" href="<?php echo url_for('/vendor/bootstrap3-editable/css/bootstrap-editable.css') ?>">

    <!-- My Custom CSS -->
    <link rel="stylesheet" href="<?php echo url_for('/css/hr_custom.css'); ?>">
  
  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="margin-bottom: 20px;">
      <div class="container">
        <a class="navbar-brand" href="<?php echo WWW_ROOT . '/hr/index.php'?>">HR Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Candidates In Process</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url_for('/hr/hr_candidates/new.php') ?>">Add New Candidate</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url_for('/hr/hr_users/index.php') ?>">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Settings</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
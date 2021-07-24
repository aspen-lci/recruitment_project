<?php 
    if(!isset($page_title)) { $page_title = 'HR';}
    require_login();

    if($_SESSION['user_type'] == '1' OR $_SESSION['user_type'] == '3' OR $_SESSION['user_type'] == '5'){
    }else{
      redirect_to(url_for('logout.php'));
    }
    
?>

<!doctype html>

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
    <link href="<?php echo url_for('/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4071952ce3.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo url_for('/css/heroic-features.css'); ?>" rel="stylesheet">

    <!-- Bootstrap Table -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
    

    <!-- X-editable -->
    <link rel="stylesheet" href="<?php echo url_for('/vendor/bootstrap3-editable/css/bootstrap-editable.css') ?>">

    <!-- jQuery UI|Date Picker -->
    <link href= 
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'> 
      
    <script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > 
    </script> 
      
    <script src= 
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" > 
    </script> 

   

    <!-- My Custom CSS -->
    <link rel="stylesheet" href="<?php echo url_for('/css/hr_custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo url_for('/css/cards.css'); ?>">

    <!-- Myriad Pro Font -->
    <link rel="stylesheet" href="https://use.typekit.net/kux2cbc.css">

  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container d-flex justify-content-between">
        <div>
        <a class="navbar-brand"  href="<?php echo WWW_ROOT . '/hr/index.php'?>"><h2>HR Dashboard</h2></a>
        </div>

       

        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
        <div claa="d-flex justify-content-center" id="welcome">
          <span class="navbar-text" id="welcome"><?php echo (empty($_SESSION['first_name'])) ? 'Hello!' : 'Hello, ' . $_SESSION['first_name'] . '!'; ?></span>
        </div>
        
        <div class="d-flex justify-content-end">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url_for('/hr/hr_users/index.php'); ?>">All Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url_for('/hr/hr_candidates/new.php'); ?>">Add New Candidate</a>
            </li>
            
            
            
            <li class="nav-item">
              <a href="<?php echo url_for('/logout.php'); ?>" class="nav-link btn" id="logout-btn" role="button">Log Out</a>
            </li>
          </ul>
        </div>
</div>
      </div> <!-- end container -->
      <!-- <div>
      <a href="<?php echo url_for('/logout.php'); ?>" class="btn d-none d-lg-inline-block" id="logout-btn" role="button">Log Out</a>
      </div> -->
    </nav>
    <?php echo display_session_message(); ?>
    <?php echo display_errors($errors); ?>
    
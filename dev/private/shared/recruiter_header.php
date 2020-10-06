<?php 
    if(!isset($page_title)) { $page_title = 'HR';}
    require_login();
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

    <!-- timepicker polyfill -->
    <link href= 
'<?php echo url_for('/css/time-polyfill.css') ?>'
          rel='stylesheet'> 

          <script src= 
"<?php echo url_for('/js/time-polyfill.min.js') ?>"> 
    </script>

    <!-- My Custom CSS -->
    <link rel="stylesheet" href="<?php echo url_for('/css/hr_custom.css'); ?>">
  
  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="margin-bottom: 20px;">
      <div class="container">
        <div>
        <a class="navbar-brand"  href="<?php echo WWW_ROOT . '/recruiter/index.php'?>"><h2>Recruiter Dashboard</h2></a>
        </div>

       

        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
        <!-- <div id="welcome"> -->
          <span class="navbar-text" id="welcome"><?php echo (empty($_SESSION['first_name'])) ? 'Hello!' : 'Hello, ' . $_SESSION['first_name'] . '!'; ?></span>
        <!-- </div> -->
          <ul class="navbar-nav ml-auto">
          <!--  <li class="nav-item">
              <p><?php echo (empty($_SESSION['first_name'])) ? 'Hello!' : 'Hello, ' . $_SESSION['first_name'] . '!'; ?></p>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="<?php echo url_for('/hr/hr_candidates/new.php') ?>">Add New Candidate</a>
            </li>
            
            <!-- <li class="nav-item">
              <a href="<?php echo url_for('/logout.php'); ?>" class="nav-link btn" id="logout-btn" role="button">Log Out</a>
            </li> -->
          </ul>
        </div>
        
      </div>
      <div>
      <a href="<?php echo url_for('/logout.php'); ?>" class="btn d-none d-lg-inline-block" id="logout-btn" role="button">Log Out</a>
      </div>
    </nav>
    <?php echo display_session_message(); ?>
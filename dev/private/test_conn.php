<?php
  $host_name = 'db5000839811.hosting-data.io';
  $database = 'dbs741386';
  $user_name = 'dbu1131488';
  $password = 'nta1tD8taBa53PW!';

  $link = new mysqli($host_name, $user_name, $password, $database);

  if ($link->connect_error) {
    die('<p>Failed to connect to MySQL: '. $link->connect_error .'</p>');
  } else {
    echo '<p>Connection to MySQL server successfully established.</p>';
  }
?>
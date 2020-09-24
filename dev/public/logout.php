<?php
require_once('../private/initialize.php');

session_unset();


redirect_to(url_for('/login.php'));

?>

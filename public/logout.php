<?php
require_once('../private/initialise.php');
session_start();
$_SESSION['id'] = "";
$_SESSION['name'] = "";
$_SESSION["role"] = "";
$_SESSION["logged_in"] = false;
session_destroy();
redirect_to(url_for('index.php'));
?>
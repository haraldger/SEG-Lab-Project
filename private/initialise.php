<?php 
/* 
Code required to initialise any webpage.
*/


ob_start(); // output buffering

define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');
define("CLASSES_PATH", SHARED_PATH . '/classes');

//require_once('functions.php');
//require_once('database.php');
//require_once('query_functions.php');
//require_once('validation_functions.php');

// $db = db_connect();
$errors = [];

?>

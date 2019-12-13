<?php 
/* 
Code required to initialise any webpage for KCL Chess Society.
*/
ob_start(); // begin output buffering
             
// Display error messages (if any), instead of a white screen
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

// Path names used through out project
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');
define("CLASSES_PATH", SHARED_PATH . '/classes');

// For dynamically finding URLs
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

// functional files
require_once('functions.php');
require_once('database.php');
require_once('validation_functions.php');

// class files
require_once('classes/databaseobject.class.php');
require_once('classes/member.class.php');
require_once('classes/news.class.php');
require_once('classes/societyevent.class.php');
require_once('classes/tournament.class.php');
require_once('classes/match.class.php');

// connect to and set the database
$database = db_connect();
DatabaseObject::set_database($database);
?>

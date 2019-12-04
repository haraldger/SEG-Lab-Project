<?php 
// Common functions used throughout project

/* Dynamically find a url */
function url_for($script_path){
	if($script_path[0] != '/'){
		$script_path = "/" . $script_path;
	}
	return WWW_ROOT . $script_path;
}

/* URL escaping */
function u($string=""){
	return urlencode($string);
}

/* HTML escaping */
function h($string=""){
	return htmlspecialchars($string);
}

/* Redirects to a given location */
function redirect_to($location){
	header("Location: " . $location);
	exit;
}

/* Checks if web page loaded through a post request */
function is_post_request(){
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

/*Checks whether web page loaded through get request */
function is_get_request(){
	return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

?>

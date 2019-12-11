<?php 
// Common functions used throughout project

function am_logged_in(){
  session_start();
  if (isset($_SESSION["logged_in"])){
    if ($_SESSION["logged_in"] == true){
      return true;
    }
  }
  return false;
}

function insert_blacklist($email, $database){
  $sql = "INSERT INTO blacklist (email) " .  "VALUES ('" . $database->escape_string($email) . "');";
  $result = $database->query($sql);
}

function am_member(){
  session_start();
  if (isset($_SESSION["logged_in"])){
    if ($_SESSION["logged_in"] == true){
      if ($_SESSION["role"] == "Member"){
        return true;
      }
    }
  }
  return false;
}

function am_sysadmin(){
  session_start();
  if (isset($_SESSION["logged_in"])){
    if ($_SESSION["logged_in"] == true){
      if ($_SESSION["role"] == "System Admin"){
        return true;
      }
    }
  }
  return false;
}

function am_officer(){
  session_start();
  if (isset($_SESSION["logged_in"])){
    if ($_SESSION["logged_in"] == true){
      if ($_SESSION["role"] == "Officer"){
        return true;
      }
    }
  }
  return false;
}

function get_session_name(){
  session_start();
  if (isset($_SESSION["logged_in"])){
    if ($_SESSION["logged_in"] == true){
      $name = $_SESSION["name"];
      return $name;
    }
  }
  return "";
}

function get_session_id(){
  session_start();
  if (isset($_SESSION["logged_in"])){
    if ($_SESSION["logged_in"] == true){
      $name = $_SESSION["id"];
      return $name;
    }
  }
  return false;
}


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

function generate_first_round($participant_ids) {
  // LIMIT NUM. OF PARTICIPANTS TO BETWEEN 4 AND 32

  // calculate number of bye matches
  $num_participants = count($participant_ids);
  $num_byes = 0;

  if ($num_participants < 32) {
    if ($num_participants > 16) $num_byes = 32 - $num_participants;
    else {
      if ($num_participants > 8) $num_byes = 16 - $num_participants;
      else {
        if ($num_participants > 4) $num_byes = 8 - $num_participants;
      }
    }
  }

  // randomize participant list
  shuffle($participant_ids);

  // add byes to participant list
  $array_index = 0;
  for ($i = 0; $i < $num_byes; $i++) {
    array_splice($participant_ids, $array_index, 0, "-1");
    $array_index += 2; 
  }

  return generate_next_round($participant_ids);
}

function generate_next_round($participant_ids) {
  $match_ids = array();
  for ($i = 0; $i < count($participant_ids); $i+=2){
    array_push($match_ids, array("competitorID1" => $participant_ids[$i], "competitorID2" => $participant_ids[$i+1]));
  }
  return $match_ids;
}

?>

<?php
// Common functions used throughout project

function am_logged_in(){
  session_start();
  if (isset($_SESSION["logged_in"])) {
    if ($_SESSION["logged_in"] == true) {
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
  if (isset($_SESSION["logged_in"])) {
    if ($_SESSION["logged_in"] == true) {
      if ($_SESSION["role"] == "Member") {
        return true;
      }
    }
  }
  return false;
}

function am_sysadmin(){
  session_start();
  if (isset($_SESSION["logged_in"])) {
    if ($_SESSION["logged_in"] == true) {
      if ($_SESSION["role"] == "System Admin") {
        return true;
      }
    }
  }
  return false;
}

function am_officer(){
  session_start();
  if (isset($_SESSION["logged_in"])) {
    if ($_SESSION["logged_in"] == true) {
      if ($_SESSION["role"] == "Officer") {
        return true;
      }
    }
  }
  return false;
}

function get_session_name(){
  session_start();
  if (isset($_SESSION["logged_in"])) {
    if ($_SESSION["logged_in"] == true) {
      $name = $_SESSION["name"];
      return $name;
    }
  }
  return "";
}

function get_session_id(){
  session_start();
  if (isset($_SESSION["logged_in"])) {
    if ($_SESSION["logged_in"] == true) {
      $name = $_SESSION["id"];
      return $name;
    }
  }
  return false;
}


/* Dynamically find a url */
function url_for($script_path){
  if ($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

/* URL escaping */
function u($string = ""){
  return urlencode($string);
}

/* HTML escaping */
function h($string = ""){
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

function display_errors($errors = array()) {
  $output = '';
  if (!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach ($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function find_last_round($tournament_id, $database) {
  $sql = "SELECT roundNum FROM tournamentmatches ";
  $sql .= "WHERE tournamentID = '" . $tournament_id;
  $sql .= "' ORDER BY roundNum DESC LIMIT 1";
  $result = $database->query($sql);
  if (!$result) {
    exit("Database query failed.");
  }
  $record = $result->fetch_assoc();
  $result->free();
  if (isset($record['roundNum'])) return $record['roundNum'];
  else return 0;
}

function check_if_round_finished($tournament_id, $round_num, $database){
  $sql = "SELECT * FROM tournamentMatches WHERE ";
  $sql .= "tournamentID = '" . $tournament_id;
  $sql .= "' AND roundNum = '" . $round_num;
  $sql .= "' AND winner = '0'";
  $result = $database->query($sql);
  if (!$result) {
    exit("Database query failed.");
  }
  if ($result->num_rows == 0) return true;
  else return false;
}

function get_last_round_winners($tournament_id, $round_num, $database){
  $sql = "SELECT winner FROM tournamentMatches WHERE ";
  $sql .= "tournamentID = '" . $tournament_id;
  $sql .= "' AND roundNum = '" . $round_num . "'";
  $result = $database->query($sql);
  if (!$result) {
    exit("Database query failed.");
  }
  $competitor_ids = array();
  while ($record = $result->fetch_assoc()) {
    array_push($competitor_ids, $record['winner']);
  }
  $result->free();
  return $competitor_ids;
}

function winner_found($tournament_id, $round_num, $database){
  $sql = "SELECT winner FROM tournamentMatches WHERE ";
  $sql .= "tournamentID = '" . $tournament_id . "' AND ";
  $sql .= "roundNum = '" . $round_num . "'";
  $result = $database->query($sql);
  if (!$result) {
    exit("Database query failed.");
  }
  if ($result->num_rows == 1) {
    $winner_id = $result->fetch_assoc()['winner'];
    $result->free();
    $sql = "SELECT members.fName, members.lName FROM tournamentMatches, members WHERE ";
    $sql .= "tournamentID = '" . $tournament_id . "' AND ";
    $sql .= "roundNum = '" . $round_num . "' AND ";
    $sql .= "winner = '" . $winner_id . "' AND tournamentMatches.winner = members.id";
    $result = $database->query($sql);
    $record = $result->fetch_assoc();
    $winner_name = $record['fName'] . ' ' . $record['lName'];
    $result->free();
    return $winner_name;
  } else return -1;
}

function check_competitor_size($tournament_id, $database){
  $sql = "SELECT competitorID FROM tournamentCompetitors WHERE ";
  $sql .= "tournamentID = '" . $tournament_id . "'";
  $result = $database->query($sql);
  if (!$result) {
    exit("Database query failed.");
  }
  $num = $result->num_rows;
  if ($num == 4 || $num == 8 || $num == 16 || $num == 32) return true;
  else return false;
}

function get_round_matches($tournament_id, $round_num, $database){
  $sql = "SELECT id FROM tournamentMatches WHERE ";
  $sql .= "tournamentID = '" . $tournament_id;
  $sql .= "' AND roundNum = '" . $round_num . "'";
  $result = $database->query($sql);
  if (!$result) {
    exit("Database query failed.");
  }
  $match_ids = array();
  while ($record = $result->fetch_assoc()) {
    array_push($match_ids, $record['id']);
  }
  $result->free();
  return $match_ids;
}

function get_match_competitors($match_id, $database){
  $sql = "SELECT competitorID1,competitorID2 FROM tournamentmatches WHERE ";
  $sql .= "id = '" . $match_id . "'";
  $result = $database->query($sql);
  if (!$result) {
    exit("Database query failed.");
  }
  $record = $result->fetch_assoc();
  $competitor_ids = array("competitorID1" => $record['competitorID1'], "competitorID2" => $record['competitorID2']);
  $result->free();

  $sql = "SELECT members.email FROM tournamentMatches, members WHERE ";
  $sql .= "tournamentMatches.id = '" . $match_id . "' AND ";
  $sql .= "competitorID1 = '" . $competitor_ids["competitorID1"] . "' ";
  $sql .= 'AND tournamentmatches.competitorID1 = members.id';
  $result = $database->query($sql);
  if (!$result) {
    exit("Database query failed.");
  }
  $record = $result->fetch_assoc();
  $competitor_email_1 = $record['email'];
  $result->free();

  $sql = "SELECT members.email FROM tournamentMatches, members WHERE ";
  $sql .= "tournamentMatches.id = '" . $match_id . "' AND ";
  $sql .= "competitorID2 = '" . $competitor_ids["competitorID2"] . "'";
  $sql .= 'AND tournamentmatches.competitorID2 = members.id';
  $result = $database->query($sql);
  if (!$result) {
    exit("Database query failed.");
  }
  $record = $result->fetch_assoc();
  $competitor_email_2 = $record['email'];
  $result->free();

  $competitors = array("compID1" => $competitor_ids["competitorID1"], "compEmail1" => $competitor_email_1, "compID2" => $competitor_ids["competitorID1"], "compEmail2" => $competitor_email_2);

  return $competitors;
}

function generate_next_round($participant_ids){
  shuffle($participant_ids);
  $match_ids = array();
  for ($i = 0; $i < count($participant_ids); $i += 2) {
    array_push($match_ids, array("competitorID1" => $participant_ids[$i], "competitorID2" => $participant_ids[$i + 1]));
  }
  return $match_ids;
}

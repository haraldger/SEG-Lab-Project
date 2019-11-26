<?php

  // Members

  function find_all_members() {
    global $db;
    $sql = "SELECT * FROM members ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_member_by_id($id) {
    global $db;
    $sql = "SELECT * FROM members ";
    $sql .= "WHERE memberID='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $member = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $member;
  }

  function validate_member($member) {
    $errors = [];

    // first name
    if(is_blank($member['fName'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($member['fName'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    // last name
    if(is_blank($member['lName'])) {
      $errors[] = "Name cannot be blank.";
    } elseif(!has_length($member['lName'], ['min' => 2, 'max' => 255])) {
      $errors[] = "Name must be between 2 and 255 characters.";
    }

    // address - needs better validation XXX
    if(is_blank($member['address'])) {
      $errors[] = "Address cannot be blank.";
    } elseif(!has_length($member['address'], ['min' => 20, 'max' => 255])) {
      $errors[] = "Address must be between 20 and 255 characters.";
    }

    // phone number - better validation? XXX
    if(is_blank($member['phoneNum'])) {
      $errors[] = "Phone number cannot be blank.";
    } elseif(!(strlen($member['phoneNum'])==11)) {
      $errors[] = "Phone number must be 11 characters.";
    }

    // gender uses radio buttons so it doesn't need validation

    // date of birth - needs better validation XXX
    if(is_blank($member['address'])) {
      $errors[] = "Date of birth cannot be blank.";
    }

    return $errors;
  }

  function update_member($member) {
    global $db;

    $errors = validate_member($member);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE members SET ";
    $sql .= "fName='" . db_escape($db, $member['fName']) . "', ";
    $sql .= "lName='" . db_escape($db, $member['lName']) . "', ";
    $sql .= "address='" . db_escape($db, $member['address']) . "', ";
    $sql .= "phoneNum='" . db_escape($db, $member['phoneNum']) . "', ";
    $sql .= "dob='" . db_escape($db, $member['dob']) . "', ";
    $sql .= "gender='" . db_escape($db, $member['gender']) . "' ";
    $sql .= "WHERE memberID='" . db_escape($db, $member['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } 
    else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_member($id) {
    global $db;

    $sql = "DELETE FROM members ";
    $sql .= "WHERE memberID='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

?>

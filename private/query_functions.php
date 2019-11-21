<?php

  // Members

  function find_all_members() {
    global $db;
    $sql = "SELECT * FROM members ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

?>

<?php

class Tournament extends DatabaseObject {

  static protected $table_name = 'tournaments';
  static protected $db_columns = ['id', 'name', 'signupDeadline'];

  public $id;
  public $name;
  public $signupDeadline;

  public function __construct($args=[]) {
    $this->name = $args['name'] ?? '';
    $this->signupDeadline = $args['signupDeadline'] ?? '';
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->name)) {
      $this->errors[] = "Name of tournament cannot be blank.";
    }
    if(is_blank($this->signupDeadline)) {
      $this->errors[] = "Signup deadline cannot be blank.";
    }
    return $this->errors;
  }


}

?>

<?php

abstract class Tournament extends DatabaseObject {

  static protected $table_name = 'tournaments';
  static protected $db_columns = ['id', 'creatorid', 'title', 'description', 'signupdeadline'];

  public $id;
  public $creatorid;
  public $title;
  public $description;
  public $signupdeadline;

  public function __construct($args=[]) {
    $this->creatorid = $args['creatorid'] ?? '';
    $this->title = $args['title'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->signupdeadline = $args['signupdeadline'] ?? '';
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->creatorid)) {
      $this->errors[] = "Creator id cannot be blank.";
    }
    if(is_blank($this->title)) {
      $this->errors[] = "Title cannot be blank.";
    }
    if(is_blank($this->description)) {
      $this->errors[] = "Title cannot be blank.";
    }
    if(is_blank($this->signupdeadline)) {
      $this->errors[] = "Signup deadline cannot be blank.";
    }
    return $this->errors;
  }


}

?>

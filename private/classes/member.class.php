<?php

require_once('databaseobject.class.php');

class Member extends DatabaseObject {

  static protected $table_name = "members";
  static protected $db_columns = ['id', 'fName', 'lName', 'email', 'address', 'phoneNum', 
             'gender', 'dob', 'rating', 'role', 'hashed_password'];

  public $id;
  public $fName;
  public $lName;
  public $email;
  public $address;
  public $phoneNum;
  public $gender;
  public $dob;
  public $rating;
  public $role;

  protected $hashed_password;
  public $password;
  public $confirm_password;
  protected $password_required = true;

//  public const ROLES = ['MEMBER', 'OFFICER', 'SYSADMIN'];    

  public function __construct($args=[]) {
    $this->fName = $args['fName'] ?? '';
    $this->lName = $args['lName'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->phoneNum = $args['phoneNum'] ?? '';
    $this->gender = $args['gender'] ?? '';
    $this->dob = $args['dob'] ?? '';
    $this->rating = $args['rating'] ?? '1000';
    $this->role = $args['role'] ?? 'MEMBER';
    $this->password = $args['password'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
  }

  public function full_name() {
    return $this->fName . " " . $this->lName;
  }

  protected function set_hashed_password() {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password) {
    return password_verify($password, $this->hashed_password);
  }

  protected function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  protected function update() {
    if($this->password != '') {
      $this->set_hashed_password();
      // validate password
    } else {
      // password not being updated, skip hashing and validation
      $this->password_required = false;
    }
    return parent::update();
  }

  protected function validate() {
    $this->errors = [];

    $sql = "SELECT * FROM blacklist WHERE " . "email = '" . self::$database->escape_string($this->email) . "' LIMIT 1;";
    $blacklist_res = $this::$database->query($sql);
    $banned = $blacklist_res->fetch_assoc();
    if ($banned) {
      $this->errors[] = "This email has been banned.";
      return $this->errors;
    }

    if(is_blank($this->fName)) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length($this->fName, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($this->lName)) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length($this->lName, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    } elseif (!has_unique_email($this->email, $this->id ?? 0)) {
      $this->errors[] = "Email already exists.";
    }

    if(is_blank($this->dob)){
      $this->errors[] = "Date of Birth cannot be blank.";
    }

    if(is_blank($this->rating)){
      $this->errors[] = "Rating cannot be blank.";
    }

    if(is_blank($this->role)){
      $this->errors[] = " Role cannot be blank."; 
    }

    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->errors[] = "Password cannot be blank.";
      } elseif (!has_length($this->password, array('min' => 6))) {
        $this->errors[] = "Password must contain 6 or more characters";
      } elseif (!preg_match('/[A-Za-z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 letter";
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 number";
      } 

      if(is_blank($this->confirm_password)) {
        $this->errors[] = "Confirm password cannot be blank.";
      } elseif ($this->password !== $this->confirm_password) {
        $this->errors[] = "Password and confirm password must match.";
      }
    }

    return $this->errors;
  }

  static public function find_by_email($email) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

}

?>

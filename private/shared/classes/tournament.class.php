<?php

require_once('databaseobject.class.php');


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

  /**
   * Adds a given organiser to a tournament
   */
  public function add_organiser($memberid){
    $sql = "INSERT INTO tournamentOrganisers(tournamentID, organiserID) VALUES ($this->id, $memberid)";
    $result = self::$database->query($sql);
    if (!$result){
      $this->errors[] = "Insertion of organiser failed. Either member id doesnt exist or member is already an organiser.";
    }
  }

  /**
   * Get an array of those member objects that are organisers for this tournament
   */
  public function get_organisers(){
    $sql = "SELECT DISTINCT * from members WHERE members.id IN "
            ."(SELECT organiserID FROM tournamentOrganisers WHERE tournamentID=$this->id)";
    return Member::find_by_sql($sql);
  }
  
  /**
   * Get an array of competitors that are signed up for this tournament
   */
  public function get_competitors(){
    $sql = "SELECT DISTINCT * from members WHERE members.id IN "
            ."(SELECT competitorID FROM tournamentCompetitors WHERE tournamentID=$this->id)";
    return Member::find_by_sql($sql);
  }

  /**
   * Remove an organiser from a tournament
   */
  public function remove_organiser($memberid){
    $sql = "DELETE FROM tournamentOrganisers WHERE tournamentID=$this->id AND organiserID=$memberid";
    $result = self::$database->query($sql);
  }

  /**
   * Check if a member is an organiser for this tournament
   */
  public function has_organiser($memberid){
    $sql = "SELECT * FROM tournamentOrganisers WHERE tournamentID=$this->id AND organiserID=$memberid";
    $result = self::$database->query($sql);
    if (mysqli_num_rows($result)==1){
      return true;
    }
    return false;
  }



}

?>

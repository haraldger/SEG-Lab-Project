<?php

require_once('databaseobject.class.php');

/**
 * A class to represent a chess tournament 
 */
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

  /**
   * Adds a given competitor to a tournament.
   */
  public function add_competitor($memberid){
    $member = Member::find_by_id($memberid);
    $sql = "INSERT INTO tournamentCompetitors(tournamentID, competitorID, initrating) VALUES ($this->id, $memberid, $member->rating)";  
    $result = self::$database->query($sql);
    if (!$result){
      $this->errors[] = "Insertion of competitor failed. Either member id doesnt exist or member is already a competitor.";
    }
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
   * Remove an competitor from a tournament
   */
  public function remove_competitor($memberid){
    $sql = "DELETE FROM tournamentCompetitors WHERE tournamentID=$this->id AND competitorID=$memberid";
    $result = self::$database->query($sql);
  }

  /**
   * Check if a member is a competitor in this tournament.
   */
  public function has_competitor($memberid){
    $sql = "SELECT * FROM tournamentCompetitors WHERE tournamentID=$this->id AND competitorID=$memberid";
    $result = self::$database->query($sql);
    if (mysqli_num_rows($result)==1){
      return true;
    }
    return false;
  }


  public function get_init_rating($memberid){
    $sql = "SELECT * from tournamentCompetitors WHERE tournamentID=$this->id AND competitorID=$memberid";
    $result = self::$database->query($sql);
    if(!$result || mysqli_num_rows($result)!=1) {
      exit("The member hasn't signed up for this tournament!");
    }
    $tournamentCompetitor = $result->fetch_assoc();
    return intval($tournamentCompetitor["initrating"]);
  }
}

?>

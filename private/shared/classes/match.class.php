<?php
    require_once('databaseobject.class.php');
    require_once('tournament.class.php');
    require_once('member.class.php');

    class Match {
        static protected $table_name = "tournamentMatches";
        static protected $db_columns = ['id', 'tournamentID', 'matchDate', 'competitorID1', 'competitorID2', 'winner'];

        public $id;
        public $tournamentID;
        public $matchDate;
        public $competitorID1;
        public $competitorID2;
        public $winner;


        public function __construct($args=[]) {
            $this->id = $args['id'] ?? '';
            $this->tournamentID = $args['tournamentID'] ?? '';
            $this->matchDate = $args['matchDate'] ?? '';
            $this->competitorID1 = $args['competitorID1'] ?? '';
            $this->competitorID2 = $args['competitorID2'] ?? '';
            $this->winner = $args['winner'] ?? '';
        }

        public function validate(){
            $this->errors = [];
            
            if ($this->tournamentID == ''){
                $this->errors[] = "Tournament ID cannot be null.";
            } else {
                $tournament = Tournament::find_by_id($this->tournamentID);
                if (sizeof($tournament) != 1){
                    $this->errors[] = "Tournament ID does not exist in the tdata ";
                }
            }

            if ($this->matchDate == ''){
                $this->errors[] = "Match date cannot be empty.";
            }

            if ($this->competitorID1 == ''){
                $this->errors[] = "Competitor 1 cannot have no value";
            }
            
            if ($this->competitorID2 == ''){
                $this->errors[] = "Competitor 2 cannot have no value";
            }
        }

        public function calculateElo(){
            if ($this->winner != '' && $this->competitorID1!='' && $this->competitorID2!=''){
                $m1 = Member::find_by_id($this->competitorID1);
                $m2 = Member::find_by_id($this->competitorID2);

                $P1 = (1.0 / (1.0 + pow(10, (($m1->rating - $m2->rating) / 400))));
                $P2 = (1.0 / (1.0 + pow(10, (($m2->rating - $m1->rating) / 400))));
                $K = 30;

                if ($this->winner == $this->$competitorID1){
                    $m1->rating = $m1->rating + $K * (1 - $P1);
                    $m2->rating = $m2->rating + $K * (0 - $P2); 
                }

                else {
                    $m1->rating = $m1->rating + $K * (0 - $P1); 
                    $m2->rating = $m2->rating + $K * (1 - $P2);
                }
            }
        }
    }

?>
<?php
    require("Content.php");

    /**
     * A class to represent an tournament.
     */
    class Tournament extends Content {

        // String, long description about the tournament
        private $description;

        // Array of all coorganizer ids
        private $coorganizers = Array();

        // Array of all participant ids
        private $participants = Array();

        // Array of all match ids
        private $matches = Array();

        // Sign up deadline
        private $deadlinedatetime;


        /**
         * Add an item to an array 
         * and return the id if it's unique else return NULL
         */
        private function addToArray($id, &$array){
            if (!in_array($id, $this->coorganizers)){
                $this->coorganizers[sizeof($this->coorganizers)] = $id;
                $this->coorganizers = array_values($this->coorganizers);
                return $id;
            }
            return NULL;
        }

        /**
         * Remove an item from an array
         * And return the id if it exists else return NULL
         */
        private function removeFromArray(String $id, Array &$array){
            if ($key = array_search($id,$array)){
                $v = $array[$key];
                unset($array[$key]);
                $array = array_values($array);
                return $v;
            }
            return NULL;

        }

        /**
         *  Constructor for creating a blank tournament.
         *  Can be filled in later using setter functions.
         */
        function __construct(String $creatorid, String $title){
            super($creatorid, $title);
        }

        /**
         *  Set description of the tournament.
         */
        public function setDescription(String $description){
            $this->description = $description;
        }

        /**
         *  Get description.
         */
        public function getDescription() : String{
            return $this->description;
        }

        /**
         *  Get a list of all coorganizer ids
         */
        public function getCoorganisers() : Array{
            return $this->coorganizers;
        }

        /**
         * Add coorganizer
         */
        public function addCoorganizer(String $id) {
            $this->addToArray($id, $this->coorganizers);
        }
        
        /**
         * Remove coorganizer
         */
        public function removeCoorganizer(String $id){
            $this->removeFromArray($id, $this->coorganizers);
        }

        /**
         * Return array of all match ids for this tournament
         */
        public function getMatches(): Array{
            return $this->matches;
        }
        
        /**
         * Add match
         */
        public function addMatch(Striing $id) {
            $this->addToArray($id, $this->matches);
        }
        
        /**
         * Remove match
         */
        public function removeMatch(String $id){
            $this->removeFromArray($id, $this->matches);
        }

        /**
         * Return array of all participant ids
         */
        public function getParticipants(): Array{
            return $this->participants;
        }

        /**
         * Add participant
         */
        public function addParticipant(Striing $id) {
            $this->addToArray($id, $this->participants);
        }
        
        /**
         * Remove participant
         */
        public function removeParticipant(String $id){
            $this->removeFromArray($id, $this->participants);
        }


        /**
         * Get a string containing information about both date and time
         * of the deadline of registration for the tournament
         */
        public function getDeadlineDatetime(){
            return $this->deadlinedatetime;
        }

        /**
         * Set the deadline datetime of the registration for the tournament
         */
        public function setDeadlineDatetime(String $s){
            $this->deadlinedatetime = $s;
        }

        /**
         * Check if we are past the deadline time
         */
        public function isPastDeadline(): bool {
            return False;

            // TODO: return DateTime('now') < $this->deadlinedatetime; 
            // but compare them in the same format?
        }

        /** 
         *  Save a tournament to the database.
         */
        public function save(){

        }

        /**     
         *  Load tournament from database.
         */
        public function load(String $id){
        }

        /**
         *  Delete a tournament from database.
         */
        public function delete(){
        }

    }

    ?>
<?php
    require("Content.php");

    /**
     * A class to represent an event.
     * Example: Disco-night, Brunch, etc.
     */
    class SocietyEvent extends Content {
        
        // String, date of event
        private $date;

        // String, starting datetime of event
        private $startdatetime;

        // String, ending datetime of event
        private $enddatetime;

        // String, location of event
        private $location;

        // String, long description about the event
        private $description;

        /**
         *  Constructor for creating a blank event.
         *  Can be filled in later using setter functions.
         */
        function __construct($creatorid, $title){
            super($creatorid, $title);
        }

        /**
         *  Set the start datetime of the event.
         */
        function setStartDateTime($datetime){
            $this->startdatetime = $datetime;
        }

        /**
         *  Set the end datetime of the event.
         */
        function setEndDateTime($datetime){
            $this->enddatetime = $datetime;
        }

        /**
         *  Get the start datetime of the event.
         */
        function getStartDateTime() : String {
            return $this->startdatetime;
        }

        /**
         *  Get the end datetime of the event.
         */
        function getEndDateTime() : String {
            return $this->enddatetime;
        }

        /**
         *  Set the location of the event.
         */
        function setLocation(String $location){
            $this->location = $location;
        }
        
        /**
         *  Get the location of the event.
         */
        function getLocation(): String{
            return $this->location;
        }

        /**
         *  Set description of the event.
         */
        function setDescription(String $description){
            $this->description = $description;
        }

        /**
         *  Get description.
         */
        function getDescription() : String{
            return $this->description;
        }

        /** 
         *  Save an object to the database.
         */
        function save(){
            
        }

        /**     
         *  Load societyevent from database.
         */
        function load(String $id){
        }

        /**
         *  Delete society event from database.
         */
        function delete(){
        }

    }

    ?>
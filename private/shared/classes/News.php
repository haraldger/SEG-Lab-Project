<?php

    require('Content.php');

    class News extends Content {
        
        // String
        private $releasedate;
        
        // String
        private $expirydate;

        function __construct($creatorid, $title){
            super($creatorid, $title);
        }
        
        /**
         * Set the expiry date
         */
        public function setExpiryDate(DateTime $date){
            $this->expirydate = $date;
        }

        /**
         * Get the expiry date
         */
        public function getExpiryDate() : DateTime{
            return $this->expirydate;
        }

        /**
         * Get the release date
         */
        public function getReleaseDate() : DateTime {
            return $this->releasedate;
        }

        /**
         * Set the release date
         */
        public function setReleaseDate(DateTime $date){
            $this->releasedate = $date;
        }
        
        /**
         * Check if the news-item has expired
         */
        public function hasExpired() : bool{
            return DateTime('now') > $this->expirydate;
        }

        /**
         * Check if the news-item can be released
         */
        public function hasReleased() : bool{
            return DateTime('now') > $this->releasedate;
        }

        /**
         * Load a news item from the database
         */
        public function load(String $id){
        }

        /**
         * Save a news item to the database
         */
        public function save(){
        }

        /**
         * Remove a news item from the database
         */
        public function delete(){

        }
    }

    ?>
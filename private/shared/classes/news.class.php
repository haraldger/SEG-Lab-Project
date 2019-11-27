<?php
	require_once('../../private/shared/classes/databaseobject.class.php');

    /**
     * A class to represent an event.
     * Example: Disco-night, Brunch, etc.
     */
    class News extends DatabaseObject{
        
        static protected $table_name = 'news';
        static protected $db_columns = ['id', 'authorID', 'title', 'description', 'releasedate', 'expirydate'];

        public $id;
        public $authorID;
        public $title;
        public $description;
        public $releasedate;
        public $expirydate;

        public function __construct($args=[]) {
            $this->authorID = $args['authorID'] ?? '';
            $this->title = $args['title'] ?? '';
            $this->description = $args['description'] ?? '';
            $this->releasedate = $args['releasedate'] ?? '';
            $this->expirydate = $args['expirydate'] ?? '';
        }

        protected function validate() {
            $this->errors = [];
        
            if(is_blank($this->authorID)) {
              $this->errors[] = "Creator id cannot be blank.";
            }
            if(is_blank($this->title)) {
              $this->errors[] = "Title cannot be blank.";
            }
            if(is_blank($this->description)) {
              $this->errors[] = "Title cannot be blank.";
            }
            if(is_blank($this->releasedate)) {
                $this->errors[] = "Release date cannot be blank.";
            }
            if(is_blank($this->expirydate)){
                $this->errors[] = "Event end date cannot be blank.";
            }
            return $this->errors;
        }
      
    }

    ?>
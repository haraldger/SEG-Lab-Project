<?php
    /**
     * A class to represent an event.
     * Example: Disco-night, Brunch, etc.
     */
    class SocietyEvent extends DatabaseObject{
        
        static protected $table_name = 'societyEvents';
        static protected $db_columns = ['id', 'creatorid', 'title', 'description', 'eventdate', 'releasedate', 'eventenddate'];

        public $id;
        public $creatorid;
        public $title;
        public $description;
        public $eventdate;
        public $releasedate;
        public $eventenddate;

        public function __construct($args=[]) {
            $this->creatorid = $args['creatorid'] ?? '';
            $this->title = $args['title'] ?? '';
            $this->description = $args['description'] ?? '';
            $this->eventdate = $args['eventdate'] ?? '';
            $this->releasedate = $args['releasedate'] ?? '';
            $this->eventenddate = $args['eventenddate'] ?? '';
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
            if(is_blank($this->eventstartdate)) {
              $this->errors[] = "Event start date cannot be blank.";
            }
            if(is_blank($this->releasedate)) {
                $this->errors[] = "Release date cannot be blank.";
            }
            if(is_blank($this->eventenddate)){
                $this->errors[] = "Event end date cannot be blank.";
            }
            return $this->errors;
        }
      
    }

    ?>
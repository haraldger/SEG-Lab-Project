<?php
    /**
     * A class to represent an event.
     * Example: Disco-night, Brunch, etc.
     */
    class SocietyEvent extends DatabaseObject{
        
        static protected $table_name = 'societyEvents';
        static protected $db_columns = ['id', 'name', 'description', 'eventDate', 'releaseDate', 'expiryDate'];

        public $id;
        public $name;
        public $description;
        public $eventDate;
        public $releaseDate;
        public $expiryDate;

        public function __construct($args=[]) {
            $this->id = $args['id'] ?? '';
            $this->name = $args['name'] ?? '';
            $this->description = $args['description'] ?? '';
            $this->eventDate = $args['eventDate'] ?? '';
            $this->releaseDate = $args['releaseDate'] ?? '';
            $this->expiryDate = $args['expiryDate'] ?? '';
        }

        protected function validate() {
            $this->errors = [];
        
            if(is_blank($this->name)) {
              $this->errors[] = "Title cannot be blank.";
            }
            if(is_blank($this->description)) {
              $this->errors[] = "Description cannot be blank.";
            }
            if(is_blank($this->eventDate)) {
              $this->errors[] = "Event date cannot be blank.";
            }
            if(is_blank($this->releaseDate)) {
                $this->errors[] = "Release date cannot be blank.";
            }
            if(is_blank($this->expiryDate)){
                $this->errors[] = "Event expiry date cannot be blank.";
            }
            return $this->errors;
        }
      
    }

    ?>
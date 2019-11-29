<?php
    /**
     * A class to represent an event.
     * Example: Disco-night, Brunch, etc.
     */
    class SocietyEvent extends DatabaseObject{
        
        static protected $table_name = 'societyEvents';
		static protected $id_name = 'eventID';
        static protected $db_columns = ['eventID', 'name', 'description', 'eventDate', 'releaseDate', 'expiryDate'];

        public $name;
        public $description;
        public $eventDate;
        public $releaseDate;
        public $expiryDate;

        public function __construct($args=[]) {
            $this->id = $args['eventID'] ?? '';
            $this->name = $args['name'] ?? '';
            $this->description = $args['description'] ?? '';
            $this->eventDate = $args['eventDate'] ?? '';
            $this->releaseDate = $args['releaseDate'] ?? '';
            $this->expiryDate = $args['expiryDate'] ?? '';
        }

        protected function validate() {
            $this->errors = [];
        
            if(is_blank($this->name)) {
              $this->errors[] = "Name cannot be blank.";
            }
            if(is_blank($this->description)) {
              $this->errors[] = "Description cannot be blank.";
            }
            if(is_blank($this->releaseDate)) {
              $this->errors[] = "Release date cannot be blank.";
            }
            if(is_blank($this->expiryDate)) {
                $this->errors[] = "Expiry date cannot be blank.";
            }
            if(is_blank($this->eventDate)){
                $this->errors[] = "Event date cannot be blank.";
            }
			if($this->releaseDate > $this->eventDate || $this->eventDate > $this->expiryDate){
				$this->errors[] = "Event date must be after release date and before expiry date";
			}
            return $this->errors;
        }
      
    }

    ?>
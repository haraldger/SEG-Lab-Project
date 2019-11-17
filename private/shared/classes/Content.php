 <?php
    /**
     * An abstract class to represent any entity that would
     * be of interest to a visitor to the site.
     */
    abstract class Content {
 
        // String, id of the content
        protected $id;

        // String, profile id of the creator
        protected $creatorid;

        // String, short description of the content 
        protected $title;
        
        function __construct(String $creatorid, String $title){
            $this->id = "";
            $this->creatordid = $creatorid;
            $this->title = $title;
        }

        /**
         * Get the id of some content
        */
        public function getId() : String{
            return $this->id;
        }

        /**
         *  Get the profile id of the creater of
         *  this content
        */
        public function getCreatorId() : String {
            return $this->id;
        }

        /**
         *   Get title 
        */
        public function getTitle() : String {
            return $this->title;
        }

        /**
         *  Set title
        */
        public function setTitle($newTitle){
            $this->title = $newTitle;
        }

        /**
         *  Load content from database
         */
        abstract function load(String $id);

        /**
         * Save content to database
         */
        abstract function save();

        /**
         * Delete content from database
         */
        abstract function delete();
    }

    ?>
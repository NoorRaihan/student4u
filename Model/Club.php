<?php

    include_once '../model/database.php';

    class Club {

        public $id = NULL;
        public $name;
        public $created_at;
        public $updated_at;

        public function create() 
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "INSERT INTO club(club_name) VALUES('$this->name')";

            if($conn->query($sql) == TRUE) {
                echo "Club created successfully!";
            }else {
                echo  "Error: " . $sql;
            }
        }

        public static function getAllClubs()
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "SELECT * FROM club";

            $results = $conn->query($sql);
            if($results == TRUE) {
                return $results; 
            }
        }
    }

?>
<?php

    include_once '../model/database.php';

    class Paperwork {

        public $id = NULL;
        public $program_name;
        public $advisor;
        public $sender_role;
        public $attached_file;
        public $response;
        public $returned_file;
        public $created_at;
        public $updated_at;
        public $status;
        public $user_id;
        public $club_id;

        public function create()
        {

            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();
            
            $sql = "INSERT INTO submission(program_name, advisor, sender_role, attached_file, created_at, updated_at, user_id, club_id)
            VALUES('$this->program_name', 
            '$this->advisor', 
            '$this->sender_role', 
            '$this->attached_file', 
            '$this->created_at', 
            '$this->created_at', 
            $this->user_id, 
            $this->club_id)";

            //var_dump($sql);
            if($conn->query($sql) == TRUE) {
                echo "Submission created successfully!";
            }else {
                echo  "Error: " . $sql;
            }
        }


    }

?>
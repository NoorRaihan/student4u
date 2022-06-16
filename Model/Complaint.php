<?php

    include_once '../model/database.php';

    class Complaint {

        public $comp_id = NULL;
        public $comp_desc;
        public $attached_file;
        public $created_at;
        public $updated_at;
        public $comp_status;
        public $user_id;
        public $hide;

        public function create()
        {

            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "INSERT INTO complaint(comp_desc,attached_file,created_at,updated_at,user_id,hide)
            VALUES('$this->comp_desc', '$this->attached_file', '$this->created_at', '$this->created_at', $this->user_id, $this->hide)";
            //var_dump($sql);

            if($conn->query($sql) == TRUE) {
                echo "Complaint created successfully!";
            }else {
                echo  "Error: " . $sql;
            }
        }
    }

?>
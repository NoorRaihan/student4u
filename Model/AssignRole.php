<?php

    include_once '../model/database.php';
    include_once '../model/User.php';

    class Assign {

        public $user_id;
        public $role_id;
        public $position = NULL;

        public function create() 
        {
            
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "INSERT INTO assign VALUES($this->user_id, $this->role_id, '$this->position')";

            if($conn->query($sql) === TRUE) {
                echo "Assign Successful!";
            } else {
                $user = new User();
                $user->delete($user_id);
                echo "Error: " . $sql;
            }

            $conn->close();
        }
    }
?>
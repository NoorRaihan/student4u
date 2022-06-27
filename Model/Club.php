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

        public static function deleteByID($id)
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "DELETE FROM club WHERE club_id = $id";

            if($result = $conn->query($sql) == TRUE) {

                session_start();
                if($conn->affected_rows != 0) {
                    $_SESSION['message'] = "Club deleted successfully!";
                    $_SESSION['modal'] = 1;
                    echo "<script>window.location.href = history.back();</script>";
                    echo "Club deleted successfully!";
                }else{
                    echo "<script>alert('Unauthorized data!'); window.location.href = history.back();</script>";
                }
            }else {
                $_SESSION['message'] = "Delete was not successful";
                $_SESSION['modal'] = 1;
                echo "<script>window.location.href = history.back();</script>";
                echo  "Error: " . $sql;
            }

        }
    }

?>
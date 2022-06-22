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


        public static function getAllPaperworks()
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "SELECT submission.*, user.matrix_no, user.user_name, club.club_name 
            FROM submission
            JOIN user ON submission.user_id = user.user_id
            JOIN club ON submission.club_id = club.club_id
            ORDER BY submission.created_at DESC";

            //var_dump($sql);
            $result = $conn->query($sql);
            if($result == TRUE) {
                return $result;
            }
        }

        public static function deleteByUID($id, $uid)
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "DELETE FROM submission WHERE sub_id = $id AND user_id = $uid";

            if($conn->query($sql) == TRUE) {
                if($conn->affected_rows != 0) {
                    echo "Paperwork deleted successfully!";
                }else{
                    echo "Data not found!";
                }
            }else {
                echo  "Error: " . $sql;
            }
        }

        public static function getPaperworkByID($id)
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "SELECT submission.*, user.matrix_no, user.user_name, club.club_name 
            FROM submission
            JOIN user ON submission.user_id = user.user_id
            JOIN club ON submission.club_id = club.club_id
            WHERE submission.sub_id = $id";

            $result = $conn->query($sql);
            if($result == TRUE) {
                if($result->num_rows > 0) {
                    $paperwork = $result->fetch_assoc();
                    return $paperwork;
                }else {
                    return NULL;
                }

            }else {
                echo  "Error: " . $sql;
            }

        }

        public static function getPaperworkByUID($id, $uid)
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "SELECT submission.*, user.matrix_no, user.user_name, club.club_name 
            FROM submission
            JOIN user ON submission.user_id = user.user_id
            JOIN club ON submission.club_id = club.club_id
            WHERE submission.sub_id = $id AND submission.user_id = $uid";

            $result = $conn->query($sql);
            if($result == TRUE) {
                if($result->num_rows > 0) {
                    $paperwork = $result->fetch_assoc();
                    return $paperwork;
                }else {
                    return NULL;
                }

            }else {
                echo  "Error: " . $sql;
            }

        }

        
    }

?>
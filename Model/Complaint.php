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

        public static function getComplaintByID($id, $uid=NULL)
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            if($uid == NULL || $uid = "") {
                $sql = "SELECT complaint.*, user.matrix_no, user.user_id, user.user_name
                FROM complaint
                JOIN user ON user.user_id = complaint.user_id
                WHERE complaint.comp_id = $id";
            }else{
                $sql = "SELECT complaint.*, user.matrix_no, user.user_id, user.user_name
                FROM complaint
                JOIN user ON user.user_id = complaint.user_id
                WHERE complaint.comp_id = $id AND complaint.user_id = $uid";
            }
            
            $result = $conn->query($sql);

            if($result == TRUE) {
                if($result->num_rows > 0) {
                    $complaint = $result->fetch_assoc();
                    return $complaint;
                }else {
                    return NULL;
                }

            }else {
                echo  "Error: " . $sql;
            }

            $conn->close();
        }

        public static function getAllComplaint($uid=NULL)
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            if($uid == NULL || $uid == "") {
                $sql = "SELECT complaint.*, user.matrix_no, user.user_name 
                FROM complaint
                JOIN user ON complaint.user_id = user.user_id";
            }else {
                $sql = "SELECT complaint.*, user.matrix_no, user.user_name 
                FROM complaint
                JOIN user ON complaint.user_id = user.user_id
                WHERE complaint.user_id = $uid";
            }

            $results = $conn->query($sql);
            if($results == TRUE) {
                return $results; 
            }
        }

        public function updateByUID()
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "UPDATE complaint
            SET comp_desc = '$this->comp_desc',
            attached_file = '$this->attached_file',
            updated_at = '$this->updated_at'
            WHERE comp_id = $this->comp_id AND user_id = $this->user_id";

            if($conn->query($sql) == TRUE) {
                echo "Complaint updated successfully!";
            }else {
                echo  "Error: " . $sql;
            }
        }
    }

?>
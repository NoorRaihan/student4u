<?php

    include_once '../model/database.php';


    class User {

        public $matrix_no;
        public $user_name;
        public $user_gender;
        public $user_password;
        public $user_phone;
        public $user_email;
        public $created_at;
        public $updated_at;

        public function create() 
        {

            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            $sql = "INSERT INTO user(matrix_no, user_name, user_gender, user_password, user_phone, user_email, created_at, updated_at)
            VALUES('$this->matrix_no', '$this->user_name', '$this->user_gender', '$this->user_password', '$this->user_phone', '$this->user_email', '$this->created_at', '$this->created_at')";

            if($conn->query($sql) === TRUE) {
                echo "User created successfully!";
            }else {
                echo  "Error: " . $sql;
            }

            $conn->close();
        }

        public function get_user($id=NULL, $matrix=NULL) 
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();

            //convert to the integer value
            $id = intval($id); 

            $sql = "SELECT * FROM user WHERE user_id = $id OR matrix_no = $matrix";

            if($result = $conn->query($sql) === TRUE) {
                if($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    return $user;
                }
            }else {
                echo  "Error: " . $sql;
            }

            $conn->close();
        }

        public function update($id=NULL, $matrix=NULL) 
        {
            //get a DB connection
            $instance = Database::getInstance();
            $conn = $instance->getDBConnection();
            $timestamp = strftime('%Y-%m-%d %H:%M:%S');

            $sql = "UPDATE user 
            SET user_name = $this->user_name,
            user_password = $this->user_password,
            user_gender = $this->user_gender,
            user_phone = $this->user_phone,
            user_email = $this->user_email,
            updated_at = $timestamp
            WHERE user_id = $id OR matrix_no = $id";

            if($conn->query($sql) === TRUE) {
                echo "User updated successfully!";
            }else {
                echo  "Error: " . $sql;
            }

            $conn->close();
        }
    }

?>
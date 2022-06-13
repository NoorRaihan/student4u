<?php

    class Database {

        private static instance = null;
        private $conn;

        private $server = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "student4u";

        private function __construct() {

            $this->conn = new mysqli($server, $username, $password, $dbname) or die($this->conn);
        }

        public static function getInstance() {

            if(!self::instance) {
                self::instance = new Database();
            }

            return self::instance;
        }

        public function getDBConnection() {
            return $this->conn;
        }
    }

?>
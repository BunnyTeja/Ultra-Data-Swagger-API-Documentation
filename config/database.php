<?php 
    class Database {
        private $servername = "localhost";
        private $database_name = "content-presentation";
        private $username = "admin";
        private $password = "aiadmin";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:servername=" . $this->servername . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>
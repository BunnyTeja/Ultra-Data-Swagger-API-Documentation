<?php
    /**
 * @OA\Info(title="LIve API Test", version="0.1")
 */
require '../vendor/autoload.php';

use \Firebase\JWT\JWT;
    class Users{

        // Connection
        private $conn;

        // Table
        private $db_table = "users";

        // Columns
        public $id;
        public $username;
        public $role;
        public $name;
        public $designation;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
/**
    * @OA\Get(path="/ultra/APIDocumentation/api/UsersData.php",
    * summary="Retrieves the top most user record",
    * @OA\Response (response="200", description="Success"),
    * @OA\Response (response="404", description="Not Found"),
    * )
    */
        // GET ALL
        public function getUsers(){
            $sqlQuery = "SELECT id, username, role, name, designation FROM " . $this->db_table . " LIMIT 1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
 /**
    * @OA\Post(path="/ultra/APIDocumentation/api/UsersRet.php",
    *   summary="Retrieve the User record based on the username",
    *   description="Search for an object, if found return it!",
    *   @OA\RequestBody(
    *       @OA\MediaType(
    *           mediaType="multipart/form-data",
    *           @OA\Schema(required={"username"}, @OA\Property(property="username", type="string"))    
    *       )
    *   ),
    *   @OA\Response (response="200", description="Success"),
    *   @OA\Response (response="404", description="Not Found"),
    *   security={ {"bearerAuth":{}}}
    * )
    */
        public function getUsersbasedonName($username) {
           
                
                   
                    $query = "SELECT id, username, role, name, designation FROM " . $this->db_table ." WHERE
                    username = :username";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(":username", $username);
                    $stmt->execute();
                    return $stmt;
               
        }

    }
?>


<?php
    /**
 * @OA\Info(title="LIve API Test", version="0.1", tags ="test")
 */
require '../vendor/autoload.php';

use \Firebase\JWT\JWT;
    class Prev{

        // Connection
        private $conn;

        // Table
        private $db_table = "nsfprevawards";



        // Columns
        public $id;
        public $awardnumber;
        public $title;
        public $program;
        public $organization;
        public $awardedAmount;
        public $NSFDirectorate;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
/**
    * @OA\Get(path="/ultra/APIDocumentation/api/Prevawards.php",
    * summary="Retrieves the top most previous award record",
    * @OA\Response (response="200", description="Success"),
    * @OA\Response (response="404", description="Not Found"),
    * )
    */
        // GET ALL
        public function getPrev(){
            $sqlQuery = "SELECT id, awardnumber, program, organization, title, awardedAmount, NSFDirectorate FROM " . $this->db_table . " LIMIT 1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

/**
    * @OA\Post(path="/ultra/APIDocumentation/api/PrevawardsRet.php",
    *   summary="Retrieve the Previous awards record based on the Award number",
    *   @OA\RequestBody(
    *       @OA\MediaType(
    *           mediaType="multipart/form-data",
    *           @OA\Schema(required={"awardnumber"}, @OA\Property(property="awardnumber", type="string"))    
    *       )
    *   ),
    *   @OA\Response (response="200", description="Success"),
    *   @OA\Response (response="404", description="Not Found"),
    *   security={ {"bearerAuth":{}}}
    * )
    */
    public function getPrevbasedonawardnum($awardnumber) {
                   
        $query = "SELECT id, awardnumber, program, organization, title, awardedAmount, NSFDirectorate FROM " . $this->db_table ." WHERE
        awardnumber = :awardnumber";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":awardnumber", $awardnumber);
        $stmt->execute();
        return $stmt;
   
}

    }
?>


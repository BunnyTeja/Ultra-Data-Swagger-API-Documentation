<?php
    /**
 * @OA\Info(title="LIve API Test", version="0.1")
 */
require '../vendor/autoload.php';

use \Firebase\JWT\JWT;
    class Prop{

        // Connection
        private $conn;

        // Table
        private $db_table = "proposalcall";

        // Columns
        public $id;
        public $agency;
        public $agencyId;
        public $title;
        public $budget;
        public $deadline;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
/**
    * @OA\Get(path="/ultra/APIDocumentation/api/ProposalCall.php",
    * summary="Retrieves the top most Proposal record",
    * @OA\Response (response="200", description="Success"),
    * @OA\Response (response="404", description="Not Found"),
    * )
    */
        // GET ALL
        public function getProp(){
            $sqlQuery = "SELECT id, agency, agencyId, title, budget, deadline FROM " . $this->db_table . " LIMIT 1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

/**
    * @OA\Post(path="/ultra/APIDocumentation/api/ProposalRet.php",
    *   summary="Retrieve the Proposal record based on the agencyId",
    *   @OA\RequestBody(
    *       @OA\MediaType(
    *           mediaType="multipart/form-data",
    *           @OA\Schema(required={"agencyId"}, @OA\Property(property="agencyId", type="string"))    
    *       )
    *   ),
    *   @OA\Response (response="200", description="Success"),
    *   @OA\Response (response="404", description="Not Found"),
    *   security={ {"bearerAuth":{}}}
    * )
    */
    public function getPropbasedonAgencyid($agencyId) {
                   
        $query = "SELECT id, agency, agencyId, title, budget, deadline FROM " . $this->db_table ." WHERE
        agencyId = :agencyId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":agencyId", $agencyId);
        $stmt->execute();
        return $stmt;
   
}

    }
?>


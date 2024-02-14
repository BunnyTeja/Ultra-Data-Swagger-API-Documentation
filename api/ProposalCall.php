<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


    include_once '../config/database.php';
    include_once '../class/prop.php';

   

    $database = new Database();
    $db = $database->getConnection();

    $items = new Prop($db);

    $stmt = $items->getProp();
    $itemCount = $stmt->rowCount();


    //echo json_encode($itemCount);

    if($itemCount > 0){
        http_response_code(200);
        $userArr = array();
        $userArr["body"] = array();
       // $userArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);


            $e = array(
                "id" => $id,
                "agency" => $agency,
                "agencyId" => $agencyId,
                "title" => $title,
                "budget" => $budget,
                "deadline" => $deadline,
               
            );

            array_push($userArr["body"], $e);
        }
        echo json_encode($userArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
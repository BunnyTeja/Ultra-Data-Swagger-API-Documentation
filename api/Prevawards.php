<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


    include_once '../config/database.php';
    include_once '../class/prev.php';

   

    $database = new Database();
    $db = $database->getConnection();

    $items = new Prev($db);

    $stmt = $items->getPrev();
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
                "awardnumber" => $awardnumber,
                "title" => $title,
                "program" => $program,
                "organization" => $organization,
                "awardedAmount" => $awardedAmount,
                "NSFDirectorate" => $NSFDirectorate,
               
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
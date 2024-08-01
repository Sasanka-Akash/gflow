<?php

include "connection.php";

session_start();
$userId = $_SESSION["u"]["id"];

$error = [];

if(isset($_POST["payment"])){
    $payment = json_decode($_POST["payment"],true);

    $date = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $date->setTimezone($tz);

    $time = $date->format("Y-m-d H:i:s");

    //Insert
    Database::iud("INSERT INTO `order_history`(`order_id`,`order_date`,`amount`,`users_id`)
    VALUES('".$payment["order_id"]."','$time','".$payment["amount"]."','$userId')");

    $ohId = Database::$connection->insert_id;

    $cartRs = Database::search("SELECT * FROM `cart`  WHERE `user_id`='$userId'");
    $num = $cartRs->num_rows;

    for($x = 0;$x < $num; $x++){
        $row = $cartRs->fetch_assoc();

        $stockRs = Database::search("SELECT * FROM `product` WHERE `id`='".$row["stock_id"]."'");
        $stock = $stockRs->fetch_assoc();

        if($stock["qty"] >= $row["qty"]){
            Database::iud("INSERT INTO `order_items`(`qty`,`price`,`oh_id`,`stock_id`)VALUES
            ('".$row["qty"]."','".$stock["price"]."','$ohId','".$stock["id"]."')");

            $newQty = $stock["qty"] - $row["qty"];

            Database::iud("UPDATE `stock` SET `qty`='$newQty' WHERE `id`='".$stock["id"]."'");
            
        }else{
            $error[0] = "Insufficient Quabtuty";
        }


    }

    Database::iud("DELETE FROM `cart` WHERE `user_id`='$userId'");


}else{
    $error[0] = "InvalID Request";
}

$json = [];

if(empty($error)){
    $json["ststus"] = "success";
    $json["ohId"] = $ohId;
}else{
    $json["status"] = "error";
    $json["error"] = $error[0];
}

echo json_encode($json);
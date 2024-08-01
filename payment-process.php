<?php
session_start();
include "connection.php";

if(isset($_SESSION["u"])){

   
    $qty = $_GET["qty"];
    $uumail = $_SESSION["u"]["email"];

    $payment;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$uumail."'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$uumail."'");
    $city_num = $city_rs->num_rows;

    if($city_num == 1){

        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_city_id"];
        $address = $city_data["line1"].", ".$city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='".$city_id."'");
        $district_data = $district_rs->fetch_assoc();

        $item = [];
        $amount = ((int)$product_data["price"] * (int)$qty);

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $uaddress = $address;
        $city = $district_data["city_name"];

        $merchant_id = "1224688";
        $merchant_secret = "Mjc2OTg1MjI1MjI5MDg4MTQ5NDQyMDU5MDY5MDcyMTA4MjgxNTk2Mw==";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        $payment["id"] = $order_id;
        $payment["item"] = implode(" ",$item);
        $payment["amount"] = $amount;
        $payment["fname"] = $fname;
        $payment["lname"] = $lname;
        $payment["mobile"] = $mobile;
        $payment["address"] = $uaddress;
        $payment["city"] = $city;
        $payment["umail"] = $uumail;
        $payment["mid"] = $merchant_id;
        $payment["msecret"] = $merchant_secret;
        $payment["currency"] = $currency;
        $payment["hash"] = $hash;

        echo json_encode($payment);

    }else{
        echo ("2");
    }

}else{
    echo ("1");
}

?>
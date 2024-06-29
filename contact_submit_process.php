<?php

include "connection.php";

$name = $_POST["name"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$prod_name = $_POST["prod_name"];
$comment = $_POST["comment"];

if (empty($name)) {
    echo ("Please Enter Your Name.");
} else if (strlen($name) > 50) {
    echo ("First Name Must Contain LOWER THAN 50 characters.");
} else if (empty($email)) {
    echo ("Please Enter Your Email Address.");
} else if (strlen($email) > 100) {
    echo ("Email Addree Must Contain LOWER THAN 100 characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address.");
} else if (empty($mobile)) {
    echo ("Please Enter Your Mobile Number.");
} else if (strlen($mobile) != 10) {
    echo ("Mobile Number Must Contain 10 Charcters.");
} else if (!preg_match("/07[0,1,2,4,6,7,8,][0-9]/", $mobile)) {
    echo ("Invalid Mobile Number.");
} else if (empty($prod_name)) {
    echo ("Please Enter Your Product Name.");
}  else if (empty($comment)) {
    echo ("Please Enter Your Comment | Inquiry");
    
    
} else {

    $rs = Database::search("SELECT * FROM `contact` WHERE `cus_email` = '" . $email . "' OR `cus_mobile` = '" . $mobile . "'");
    $n = $rs->num_rows;

    if ($n > 0) {
        echo ("User with the same Email Address or same Mobile Number already exists.");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `contact`
        (`cus_name`,`cus_email`,`cus_mobile`,`cus_sub`,`cus_comments`,`date`)VALUES
        ('" . $name . "' , '" . $email . "' , '" . $mobile . "' , '" . $prod_name . "' , '" . $comment . "' , '" . $date . "')");

        echo ("success");
    }
}

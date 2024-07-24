<?php

include "connection.php";

$brand = $_POST["brand"];

if(empty($brand)){
    echo("Please enter the brand");
}else{

    $rs = Database::search("SELECT * FROM  `brand` WHERE `brand_name`='$brand'");
    $num = $rs->num_rows;

    if($num > 0){
        echo("The bradn you have entered has been already registered");
    }else{
        Database::iud("INSERT INTO `brand` (`brand_name`) VALUES ('$brand')");
        echo("success");
    }

}
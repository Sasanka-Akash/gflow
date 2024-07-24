<?php

include "connection.php";

$color = $_POST["color"];

if(empty($color)){
    echo("Please enter the color");
}else{

    $rs = Database::search("SELECT * FROM  `color` WHERE `clr_name`='$color'");
    $num = $rs->num_rows;

    if($num > 0){
        echo("The bradn you have entered has been already registered");
    }else{
        Database::iud("INSERT INTO `color` (`clr_name`) VALUES ('$color')");
        echo("success");
    }

}
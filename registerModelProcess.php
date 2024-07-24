<?php

include "connection.php";

$model = $_POST["model"];

if(empty($model)){
    echo("Please enter the category");
}else{

    $rs = Database::search("SELECT * FROM  `model` WHERE `model_name`='$model'");
    $num = $rs->num_rows;

    if($num > 0){
        echo("The bradn you have entered has been already registered");
    }else{
        Database::iud("INSERT INTO `model` (`model_name`) VALUES ('$model')");
        echo("success");
    }

}
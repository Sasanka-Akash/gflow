<?php

include "connection.php";

$category = $_POST["category"];

if(empty($category)){
    echo("Please enter the category");
}else{

    $rs = Database::search("SELECT * FROM  `category` WHERE `cat_name`='$category'");
    $num = $rs->num_rows;

    if($num > 0){
        echo("The bradn you have entered has been already registered");
    }else{
        Database::iud("INSERT INTO `category` (`cat_name`) VALUES ('$category')");
        echo("success");
    }

}
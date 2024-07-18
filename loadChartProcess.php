<?php

include "connection.php";

$rs = Database::search("SELECT * FROM `product`");

$data = [];
$labels = [];

for($i = 0; $i < $rs->num_rows;$i++){
    $row = $rs->fetch_assoc();

    $labels[] = $row["name"];
    $data[] = $row["qty"];

}

$json = [];
$json["data"] = $data;
$json["labels"] = $labels;

echo json_encode($json);
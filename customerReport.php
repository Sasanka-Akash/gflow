<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reports | Gflow</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/g1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 mt-5 d-flex justify-content-center gap-3">
                <button class="btn btn-dark" onclick="history.back();"><i class="bi bi-arrow-left"></i> Back</button>
                <button class="btn btn-danger" onclick="printReport();"><i class="bi bi-printer-fill"></i> Print</button>
            </div>
        </div>
    </div>
    <div class="container" id="printArea">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1>Customer Report</h1>
            </div>
            <div class="col-12 mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Order ID</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Date Time</td>
                            <td>Email</td>
                            <td>QTY</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rs = Database::search("SELECT `invoice`.`product_id`,`invoice`.`order_id`,`invoice`.`date`,`invoice`.`user_email`,`invoice`.`qty`, `user`.`fname`,`user`.`lname` FROM `invoice` INNER JOIN `user` ON `invoice`.`user_email`=`user`.`email`");
                        $num = $rs->num_rows;

                        for ($x = 0; $x < $num; $x++) {
                            $row = $rs->fetch_assoc();
                        ?>
                            <tr>
                                <td><?php echo ($row["product_id"]); ?></td>
                                <td><?php echo ($row["order_id"]); ?></td>
                                <td><?php echo ($row["fname"]); ?></td>
                                <td><?php echo ($row["lname"]); ?></td>
                                <td><?php echo ($row["date"]); ?></td>
                                <td><?php echo ($row["user_email"]); ?></td>
                                <td><?php echo ($row["qty"]); ?></td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
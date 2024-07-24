<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reports | Gflow</title>
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
            <div class="col-12 text-center">
                <h1>Product Report</h1>
            </div>

            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th class="col-3">Status</th>
                            <th class="col-4">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rs =  Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.model_has_brand_id,product.condition_condition_id,product.status_status_id,
    product.user_email,model.model_name AS mname,brand.brand_name AS bname FROM `product` INNER JOIN `model_has_brand`
    ON model_has_brand.id=product.model_has_brand_id  INNER JOIN `brand` ON brand.brand_id=model_has_brand.brand_brand_id
    INNER JOIN `model` ON model.model_id=model_has_brand.model_model_id");
                        $num = $rs->num_rows;

                        for ($x = 0; $x < $num; $x++) {
                            $row = $rs->fetch_assoc();

                        ?>

                            <tr>
                                <td><?php echo ($row["id"]) ?></td>
                                <td><?php echo ($row["title"]) ?></td>
                                <td><?php echo ($row["description"]) ?></td>
                                <td><?php echo ($row["category_cat_id"]) ?></td>
                                <td><?php echo ($row["bname"]) ?></td>
                                <td><?php echo ($row["mname"]) ?></td>
                                <td>
                                    <?php
                                    if ($row["status_status_id"] == "1") {
                                        echo ("Active");
                                    } else {
                                        echo ("Inactive");
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $row["id"] . "'");
                                    $img_data = $img_rs->fetch_assoc();
                                    ?>

                                    <img src="<?php echo ($img_data["img_path"]); ?>" class="w-100" >
                                </td>
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
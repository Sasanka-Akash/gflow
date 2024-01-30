<?php

include "header.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.model_has_brand_id,product.condition_condition_id,product.status_status_id,
    product.user_email,model.model_name AS mname,brand.brand_name AS bname FROM `product` INNER JOIN `model_has_brand`
    ON model_has_brand.id=product.model_has_brand_id  INNER JOIN `brand` ON brand.brand_id=model_has_brand.brand_brand_id
    INNER JOIN `model` ON model.model_id=model_has_brand.model_model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <title><?php echo $product_data["title"]; ?> | Gflow</title>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
            <link rel="stylesheet" href="style.css">


        </head>

        <body class="p-3 mb-2 bg-dark text-white">


            <div class="container" style="margin-top: 100px; padding: 50px; ">
                <div class="row">
                    <div class="col-md-6">
                        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                $image_num = $image_rs->num_rows;
                                $img = array();
                                
                                if ($image_num != 0) {
                                    for ($x = 0; $x < $image_num; $x++) {
                                        $img_data = $image_rs->fetch_assoc();
                                        $img[$x] = $img_data["img_path"];

                                ?>
                                        <div class="carousel-item active">
                                            <img src="<?php echo $img[$x]; ?>" class="d-block w-100" alt="..." onclick="loadMainImg(<?php echo $x; ?>);">
                                        </div>
                                <?php
                                    }
                                } 
                                ?>


                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <?php
                    $price = $product_data["price"];
                    $adding_price = ($price / 100) * 10;
                    $new_price = $price + $adding_price;
                    $difference = $new_price - $price;
                    ?>
                    <div class="col-md-6">
                        <div class="row ">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                </ol>
                            </nav>
                        </div>
                        <p class="newarrival text-center">NEW</p>
                        <h2><?php echo $product_data["title"]; ?></h2>
                        <p class="price fs-2">Rs. <?php echo $price; ?> .00</p>
                        <div class="product-detail">
                            <p class="fs-2">About this item:</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eveniet veniam tempora fuga tenetur placeat sapiente architecto illum soluta consequuntur, aspernatur quidem at sequi ipsa!</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, perferendis eius. Dignissimos, labore suscipit. Unde.</p>
                            <ul>
                                <li>Available: <span>In stock : <?php echo $product_data["qty"]; ?></span></li>
                                <li>Sold: <span>100 Items</span></li>
                                <li>Shipping Area: <span>Only Sri Lanka</span></li>
                                <li>Shipping Fee: <span>Free</span></li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 my-2">
                                        <div class="row g-2">
                                            <div class="col-4 d-grid">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button style="color: white;" type="button" class="btn btn"><i class="bi bi-dash-lg"  onclick="qty_dec();"></i></button>
                                                    <button type="button" class="btn btn"><input onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' type="text" class="input-group-text" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" /></button>
                                                    <button style="color: white;" type="button" class="btn btn"><i class="bi bi-plus-lg" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i></button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12 mt-5">
                                                    <div class="row">
                                                        <div class="col-4 d-grid">
                                                            <button class="btn btn-warning" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                        </div>
                                                        <div class="col-4 d-grid">
                                                            <button class="btn btn-primary">Add To Cart</button>
                                                        </div>
                                                        <div class="col-4 d-grid">
                                                            <button class="btn btn-secondary"><i class="bi bi-suit-heart-fill text-danger"></i> Add To Watchlist</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <hr>
            <div class="container  ">
                <div class="col-12 bg-dark text-white ">
                    <div class="row justify-content-center gap-5">
                        <?php

                        $related_rs = Database::search("SELECT * FROM `product` WHERE 
                                    `model_has_brand_id`='" . $product_data["model_has_brand_id"] . "' LIMIT 5");


                        $related_num = $related_rs->num_rows;
                        for ($y = 0; $y < $related_num; $y++) {
                            $related_data = $related_rs->fetch_assoc();
                        ?>

                            <div class="card " style="width: 18rem; ">

                                <?php
                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $related_data["id"] . "'");
                                $img_data = $img_rs->fetch_assoc();
                                ?>

                                <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top" />
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $related_data["title"]; ?></h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>

                        <?php
                        }

                        ?>

                    </div>
                </div>
            </div>

            <hr>

            <?php include "footer.php"; ?>
            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>
<?php

    } else {
        echo ("Sorry for the inconvenience.Please try agin later.");
    }
} else {
    echo ("Somthing Went Wrong");
}

?>
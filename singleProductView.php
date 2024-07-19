<?php

include "header-page.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.model_has_brand_id,product.condition_condition_id,product.status_status_id,
    product.user_email,model.model_name AS mname,brand.brand_name AS bname FROM `product` INNER JOIN `model_has_brand`
    ON model_has_brand.id=product.model_has_brand_id  INNER JOIN `brand` ON brand.brand_id=model_has_brand.brand_brand_id
    INNER JOIN `model` ON model.model_id=model_has_brand.model_model_id   WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <title><?php echo $product_data["title"]; ?> | Gflow</title>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- or -->
            <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
            <link rel="stylesheet" href="style.css">
            <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
            <script src="https://unpkg.com/scrollreveal"></script>
            <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


        <body class="bg">



            <div class="container" id="basicSearchResult">
                <div class="row mt-3">

                    <div class="col-12 mt-0 text-light singleProduct p-4 mt-5 ">
                        <div class="row">
                            <div class="col-12" style="padding: 10px;">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-12 align-items-center">

                                                <div class="col-6 image-container justify-content-center">
                                                    <?php
                                                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                                    $image_num = $image_rs->num_rows;

                                                    $image_data = $image_rs->fetch_assoc();

                                                    ?>
                                                    <img style="width: 500px;" src="<?php echo $image_data["img_path"]; ?>" alt="" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                                </div>
                                                <div class="row ms-5 mt-4">
                                                    <h5 class="col-7 col-lg-7 fw-bold text-warning text-center ms-4"><i class="bi bi-hand-index-thumb-fill fs-4"></i> Click On Image</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Button trigger modal -->


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content ">
                                                <div class="modal-header bg-warning">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $product_data["title"]; ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body bg-dark">

                                                    <img class="w-100" src="<?php echo $image_data["img_path"]; ?>" alt="" data-bs-toggle="modal" data-bs-target="#exampleModal1">

                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-lg-6">
                                        <div class="row mt-4">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a class="link-light text-decoration-none" href="home.php">Home</a></li>
                                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $product_data["title"]; ?></li>
                                                </ol>
                                            </nav>
                                        </div>
                                        <h1 class="mt-2 fs-1 fw-bold"><?php echo $product_data["title"]; ?></h1>
                                        <?php

                                        $price = $product_data["price"];
                                        $adding_price = ($price / 100) * 10;
                                        $new_price = $price + $adding_price;
                                        $difference = $new_price - $price;

                                        ?>
                                        <!-- <div class="row ">
                                                <div class="col-12 my-2">
                                                    <span class="fs-4 text-light"><b class="fs-4">Warrenty : </b>6 Months Warrenty</span><br />
                                                    <span class="fs-4 text-light"><b class="fs-4">Return Policy : </b>1 Months Return Policy</span><br />
                                                    <span class="fs-4 text-light"><b class="fs-4">In Stock : </b><?php echo $product_data["qty"]; ?> Items Available</span>
                                                </div>
                                            </div> -->
                                        <ul class="fs-4 mt-3">
                                            <?php
                                            echo $product_data["description"];
                                            ?>
                                        </ul>

                                        <div class="btn-group mt-4" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn " onclick="qty_dec();"><i class='bx bx-minus text-light'></i></button>
                                            <input onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' class="text-center border-rounded-bottom-circle " type="text" pattern="[0-9]" value="1" id="qty_input">
                                            <button type="button" class="btn" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'><i class='bx bx-plus text-light'></i></button>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12 my-2">
                                                <span class="fs-1 text-light fw-bold">Rs. <?php echo $price; ?> .00</span>
                                                <span class="fs-1">&nbsp;&nbsp; | &nbsp;&nbsp;</span>
                                                <span class="fs-2 text-danger fw-bold text-decoration-line-through">Rs. <?php echo $new_price; ?> .00</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mt-5">
                                                <div class="row">

                                                    <?php

                                                    if ($product_data["qty"] > 0) {
                                                    ?>
                                                        <div class="col-4 d-grid">
                                                            <button class="btn btn-warning" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>

                                                        <span class="fs-3 card-text text-danger fw-bold mb-4">Out Of Stock</span><br />
                                                        <!-- <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br /> -->
                                                        <!-- <a href='#' class="col-12 btn btn-warning disabled">Buy Now</a> -->

                                                        <div class="col-4 d-grid">
                                                            <button class="btn btn-warning disabled" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                        </div>

                                                    <?php
                                                    }

                                                    ?>


                                                    <!-- <div class="col-4 d-grid">
                                                            <button class="btn btn-dark">Add To Cart</button>
                                                        </div> -->
                                                    <?php
                                                    if (isset($_SESSION["u"])) {
                                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' AND
`product_id`='" . $product_data["id"] . "'");
                                                        $watchlist_num = $watchlist_rs->num_rows;

                                                        if ($watchlist_num == 1) {
                                                    ?>
                                                            <div class="col-4 d-grid">
                                                                <button class="btn btn-secondary" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill fs-4 text-danger" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                                </button>
                                                            </div>
                                                            <!-- <button class="col-12 btn btn-outline-light mt-2 ">
                                                                <i class="bi bi-heart-fill text-danger fs-5" ></i>
                                                            </button> -->

                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-4 d-grid">
                                                                <button class="btn btn-secondary" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                    <i class="bi bi-heart-fill fs-4 text-dark" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                                </button>
                                                            </div>
                                                    <?php
                                                        }
                                                    }




                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <nav>
                                        <div class="nav nav-tabs mt-5 text-dark" id="nav-tab" role="tablist">
                                            <button class="nav-link active " id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">DESCRIPTION</button>
                                            <!-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">ADDITIONAL INFORMATION</button> -->
                                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">FEEDBACKS</button>
                                            <!-- <button class="nav-link" id="nav-reviews-tab" data-bs-toggle="tab" data-bs-target="#nav-reviews" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">SHIPPING & DELIVERY</button> -->

                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active mt-4" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                            <?php
                                            echo $product_data["description"];
                                            ?>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">

                                        </div>
                                    </div>
                                    <div class="tab-pane fade mt-4" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">

                                        <?php

                                        $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `user` ON
                                            feedback.user_email=user.email WHERE `product_id`='" . $pid . "'");

                                        $feedback_num = $feedback_rs->num_rows;

                                        if ($feedback_num == 0) {
                                        ?>
                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="col-12 text-center mb-2">
                                                        <label class="form-label fs-1 fw-bold">
                                                            REVIEWS
                                                        </label>
                                                    </div>
                                                    <div class="col-12 text-center mb-2">
                                                        <label class="form-label fs-1 fw-bold">
                                                            There are no reviews yet.
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-12 ">
                                                <div class="row border border-1 border-dark rounded overflow-scroll me-0" style="height: 300px;">

                                                    <?php



                                                    for ($y = 0; $y < $feedback_num; $y++) {
                                                        $feedback_data = $feedback_rs->fetch_assoc();

                                                    ?>

                                                        <div class="col-12 mt-1 mb-1 mx-1">
                                                            <div class="row border border-1 border-dark rounded me-0">

                                                                <div class="col-10 mt-1 mb-1 ms-0"><?php echo $feedback_data["fname"] . " " . $feedback_data["lname"]; ?></div>
                                                                <div class="col-2 mt-1 mb-1 me-0">

                                                                    <?php

                                                                    if ($feedback_data["type"] == 1) {
                                                                    ?><span class="badge bg-success">Positive</span> <?php
                                                                                                                    } else if ($feedback_data["type"] == 2) {
                                                                                                                        ?><span class="badge bg-warning">Neutral</span> <?php
                                                                                                                                                                    } else if ($feedback_data["type"] == 3) {
                                                                                                                                                                        ?><span class="badge bg-danger">Negative</span> <?php
                                                                                                                                                                                                                    }

                                                                                                                                                                                                                        ?>


                                                                </div>

                                                                <div class="col-12">
                                                                    <b>
                                                                        <?php echo  $feedback_data["feed"]; ?>
                                                                    </b>
                                                                </div>
                                                                <div class="offset-6 col-6 text-end">
                                                                    <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php

                                                    }

                                                    ?>


                                                </div>
                                            </div>
                                        <?php
                                        }

                                        ?>


                                    </div>
                                    <div class="tab-pane fade" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviewss-tab" tabindex="0">...</div>
                                </div>



                                <div class="col-12 mt-5">
                                    <div class="row g-4 align-items-center justify-content-center" style="gap: 30px;">
                                        <?php

                                        $related_rs = Database::search("SELECT * FROM `product` WHERE 
                                    `model_has_brand_id`='" . $product_data["model_has_brand_id"] . "' LIMIT 5");


                                        $related_num = $related_rs->num_rows;
                                        for ($y = 0; $y < $related_num; $y++) {
                                            $related_data = $related_rs->fetch_assoc();

                                        ?>


                                            <div class="card card-design col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">
                                                <a href='<?php echo "singleProductView.php?id=" . ($related_data["id"]); ?>' class="link-dark text-decoration-none">
                                                    <?php
                                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $related_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();
                                                    ?>

                                                    <img src="<?php echo $img_data["img_path"]; ?>" class=" card-img justify-content-center align-items-center" style="height: 250px;" />
                                                    <div class="card-body ms-0 m-0 text-center">
                                                        <h5 class="card-title fw-bold fs-6 link-light text-decoration-none"><?php echo $related_data["title"]; ?></h5>
                                                        <!-- <span class="badge rounded-pill text-bg-info">New</span><br /> -->
                                                        <span class="fs-3 fw-bold card-text text-warning">LKR <?php echo $related_data["price"]; ?>.00</span><br />

                                                        <?php

                                                        if ($product_data["qty"] > 0) {
                                                        ?>
                                                            <div class="ms-4">
                                                                <button class="col-12 btn Btn ms-4" onclick="addToCart(<?php echo $product_data['id'] ?>);">
                                                                    <div class="sign fs-3">+ </div>
                                                                    <div class="text">Add to</div>
                                                                </button>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>

                                                            <span class="card-text text-danger fw-bold">Out Stock</span><br />
                                                            <!-- <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br /> -->
                                                            <!-- <a href='#' class="col-12 btn btn-warning disabled">Buy Now</a> -->
                                                            <div class="ms-4">
                                                                <button class="col-12 btn Btn bg-danger disabled ms-4">
                                                                    <div class="sign fs-3">+ </div>
                                                                    <div class="text">Add to</div>
                                                                </button>
                                                            </div>
                                                        <?php
                                                        }

                                                        ?>



                                                    </div>
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>




                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 text-center mt-5">
                <div class="col-12 d-none d-lg-block">
                    <p style="color: white;" class="text-center">&copy; 2023 Gflow.lk || All Rights Reserved</p>
                </div>
            </div>



            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script>
                var nav = document.querySelector('nav');
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 100) {
                        nav.classList.add('bg-dark', 'text-light');
                    } else {
                        nav.classList.remove('bg-dark', 'text-light');
                    }
                });
            </script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




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
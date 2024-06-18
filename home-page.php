<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Home | Gflow</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="icon" href="img/Screenshot 2023-12-17 202109.png">

</head>

<body class="bg">

    <div class="spinner-wrapper">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <?php include "header.php"; ?>

    <div class="container-fulid">

        <div class="carousel" data-aos="fade-down">

            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active c-item">
                        <video class="c-img w-100" autoplay loop muted plays-inline class="back-video">
                            <source src="img/y2mate.com - 2023 ROG Strix G1618  RAISE YOUR GAME CARRY YOUR SQUAD   ROG_1080p.mp4" />
                        </video>
                        <div class="carousel-caption  d-md-block poster-caption" data-aos="fade-up">
                            <p class="poster-title" style="font-size: 60px;">Welcome to Gflow Computers</p>
                            <p class="poster-txt fs-2">The World's Best Online Store By One Click.</p>
                            <a href="#chome"><button type="button" class="btn btn-warning fw-bold" style="font-size: 20px;"><i class='bx bx-down-arrow-alt fw-bold' style="font-size: 20px;"></i> Shop Now</button></a>
                        </div>
                    </div>
                    <div class="carousel-item c-item">
                        <img src="img/pc2.png" class="d-block w-100 c-img" alt="...">
                        <div class="carousel-caption  d-md-block poster-caption" data-aos="fade-up">
                            <p class="poster-title" style="font-size: 60px;">Best Gaming Laptops.</p>
                            <p class="poster-txt fs-2">Gflow Computers Only.</p>
                        </div>
                    </div>
                    <div class="carousel-item c-item">
                        <img src="img/pc1.jpg" class="d-block w-100 c-img" alt="...">
                        <div class="carousel-caption  d-md-block poster-caption" data-aos="fade-up">
                            <p class="poster-title" style="font-size: 60px;">Best Prices Computer Parts.</p>
                            <p class="poster-txt fs-2">Experience the Lowest Delivery Costs With Us.</p>
                        </div>
                    </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="col-12" id="basicSearchResult">
            <div class="row">
                <hr style="color: white;">

                <div class="container " id="chome" data-aos="fade-up">
                    <div class="input-group mt-3 mb-3">


                        <select class="form-select btn btn-warning" style="max-width: 250px;" id="basic_search_select">
                            <option value="0">All Categories</option>
                            <?php



                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $category_data["cat_id"]; ?>">
                                    <?php echo $category_data["cat_name"]; ?>
                                </option>
                            <?php
                            }

                            ?>
                        </select>
                        <input type="text" class="form-control " aria-label="Text input with dropdown button" id="basic_txt" placeholder="Search">
                        <button class="btn btn-warning" onclick="basicSearch(0);">Search</button>
                        <!-- <button class="btn btn-outline-warning" type="button" id="button-addon1"><a href="advancedSearch.php" class="btn btn-outline-warning">Advanced</a></button> -->
                    </div>
                </div>

                <hr style="color: white;">


                <?php


                $category_rs2 = Database::search("SELECT * FROM `category`");
                $category_num2 = $category_rs->num_rows;


                for ($y = 0; $y < $category_num2; $y++) {
                    $category_data2 = $category_rs2->fetch_assoc();
                ?>
                    <div class="col-12 mt-3 mb-3" data-aos="fade-right">
                        <a href="#" class="text-decoration-none text-light fs-3 fw-bold">
                            <?php echo $category_data2["cat_name"] ?></a> &nbsp;&nbsp;
                        <a href="#" class="text-decoration-none text-light fs-6">See All &nbsp;&rarr;</a>
                    </div>
                    <!-- Category Name -->
                    <!-- products -->

                    <div class="col-12 mb-3">
                        <div class="row border ">

                            <div class="col-12">
                                <div class="row justify-content-center gap-5" data-aos="zoom-in">

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $category_data2["cat_id"] . "' 
                                        AND `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                    $product_num = $product_rs->num_rows;

                                    for ($z = 0; $z < $product_num; $z++) {
                                        $product_data = $product_rs->fetch_assoc();

                                    ?>
                                        <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                            $img_data = $img_rs->fetch_assoc();
                                            ?>

                                            <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 250px;" />
                                            <div class="card-body ms-0 m-0 text-center">
                                                <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                                                <span class="badge rounded-pill text-bg-info">New</span><br />
                                                <span class="card-text text-primary"><?php echo $product_data["price"]; ?> .00</span><br />

                                                <?php

                                                if ($product_data["qty"] > 0) {
                                                ?>
                                                    <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                    <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />
                                                    <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-12 btn btn-warning">Buy Now</a>

                                                    <button class="col-12 btn btn-dark mt-2" onclick="addToCart(<?php echo $product_data['id'] ?>);">
                                                        <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                                    </button>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="card-text text-danger fw-bold">Out Stock</span><br />
                                                    <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br />
                                                    <a href='#' class="col-12 btn btn-warning disabled">Buy Now</a>

                                                    <button class="col-12 btn btn-dark mt-2 disabled">
                                                        <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                                    </button>

                                                    <?php
                                                }

                                                if (isset($_SESSION["u"])) {
                                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' AND
                                                 `product_id`='" . $product_data["id"] . "'");
                                                    $watchlist_num = $watchlist_rs->num_rows;

                                                    if ($watchlist_num == 1) {
                                                    ?>

                                                        <button class="col-12 btn btn-outline-light mt-2 border border-primary" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                            <i class="bi bi-heart-fill text-danger fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                        </button>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="col-12 btn btn-outline-light mt-2 border border-primary" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                            <i class="bi bi-heart-fill text-dark fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                        </button>
                                                <?php
                                                    }
                                                }



                                                ?>



                                            </div>
                                        </div>
                                    <?php

                                    }

                                    ?>

                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- products -->
                <?php
                }

                ?>


                <hr style="color: white;">


            </div>

        </div>



    </div>



    <?php include "footer.php"; ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 2500,
        });
    </script>

</body>

</html>
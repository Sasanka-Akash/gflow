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
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">


    <link rel="icon" href="img/g1.png">

</head>

<body class="bg">

    <div class="spinner-wrapper ">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <?php include "header-page.php"; ?>

    <div class="container-fulid" id="basicSearchResult">


        <div class="carousel" data-aos="fade-down">

            <div class="carousel slide">

                <div class="carousel-inner">
                    <div class="carousel-item active c-item">
                        <video class="c-img w-100" autoplay loop muted plays-inline class="back-video">
                            <source src="img/y2mate.com - 2023 ROG Strix G1618  RAISE YOUR GAME CARRY YOUR SQUAD   ROG_1080p.mp4" />
                        </video>
                        <div class="carousel-caption  d-md-block poster-caption" data-aos="fade-up">
                            <p class="poster-title" style="font-size: 60px;">Welcome to <span class="text-warning" style="font-size: 60px;">G</span>flow Computers</p>
                            <p class="poster-txt fs-2">The World's Best Online Store By One Click.</p>
                            <a href="#chome"><button type="button" class="btn btn-warning fw-bold" style="font-size: 20px;"><i class='bx bx-down-arrow-alt fw-bold' style="font-size: 20px;"></i> Shop Now</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="container">
            <div class="col-12 mt-3">
                
                <div class="row">



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
                            <div class="row  ">

                                <div class="col-12">
                                    <div class="row justify-content-center gap-5">

                                        <?php

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $category_data2["cat_id"] . "' 
                                        AND `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                        $product_num = $product_rs->num_rows;

                                        for ($z = 0; $z < $product_num; $z++) {
                                            $product_data = $product_rs->fetch_assoc();

                                        ?>

                                            <div class="card card-design col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">
                                                <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="link-dark text-decoration-none">
                                                    <?php
                                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();
                                                    ?>

                                                    <img src="<?php echo $img_data["img_path"]; ?>" class=" card-img justify-content-center align-items-center" style="height: 250px;" />
                                                    <div class="card-body ms-0 m-0 text-center">
                                                        <h5 class="card-title fw-bold fs-6 link-light text-decoration-none"><?php echo $product_data["title"]; ?></h5>
                                                        <!-- <span class="badge rounded-pill text-bg-info">New</span><br /> -->
                                                        <span class="fs-3 fw-bold card-text text-warning">LKR <?php echo $product_data["price"]; ?>.00</span><br />
                                                        
                                                        <?php

                                                        if ($product_data["qty"] > 0) {
                                                        ?>
                                                            <button class="col-12 btn cartbtn sci Btn btn-warning" onclick="addToCart(<?php echo $product_data['id'] ?>);">
                                                                <div class="sign fs-4 text-warning">+</div>
                                                                <div class="text text-dark">Add to</div>
                                                            </button>
                                                        <?php
                                                        } else {
                                                        ?>

                                                            <span class="card-text text-danger fw-bold">Out Stock</span><br />
                                                            <!-- <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br /> -->
                                                            <!-- <a href='#' class="col-12 btn btn-warning disabled">Buy Now</a> -->

                                                            <button class="col-12 cartbtn btn Btn btn-warning mt-2 disabled">
                                                                <i class="bi bi-cart-plus-fill text text-dark fs-5"></i>
                                                            </button>

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

                        <!-- products -->
                    <?php
                    }

                    ?>

                    <img class=" w-100 rounded mb-3" src="img/banner.jpg" />

                </div>

            </div>



        </div>


    </div>
    <?php include "footer.php"; ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        AOS.init({
            duration: 2500,
        });
    </script>

</body>

</html>
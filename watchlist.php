<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | Gflow</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



    <link rel="icon" href="img/g1.png">
</head>

<body class="p-3 mb-2 bg">

    <div class="container">
        <div class="row">

            <?php include "header-page.php";



            if (isset($_SESSION["u"])) {

                $watchlist_rs = Database::search("SELECT * FROM `watchlist` INNER JOIN `product` ON 
                watchlist.product_id=product.id   INNER JOIN `condition` ON 
                product.condition_condition_id=condition.condition_id INNER JOIN `user` ON 
                product.user_email=user.email WHERE watchlist.user_email='" . $_SESSION["u"]["email"] . "'");

                $watchlist_num = $watchlist_rs->num_rows;

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="row">

                                <div class="col-12 mt-5 text-center fs-1">
                                    <label class="form-label fs-1 text-center  mt-3 text-warning">Watchlist &hearts;</label>
                                </div>

                                <!-- <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Search in Watchlist..." />
                                        </div>
                                        <div class="col-12 col-lg-2 mb-3 d-grid">
                                            <button class="btn btn-warning">Search</button>
                                        </div>
                                    </div>
                                </div> -->



                                <!-- <div class="col-11 col-lg-2 border-0 border-end border-1 border-dark">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column ">
                                        <a class="nav-link active bg-warning text-dark" aria-current="page" href="#">My Watchlist</a>
                                        <a class="nav-link" href="cart.php">My Cart</a>
                                        <a class="nav-link" href="#">Recents</a>
                                    </nav>
                                </div> -->

                                <?php

                                if ($watchlist_num == 0) {
                                ?>
                                    <!-- empty view -->
                                    <div class="col-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 text-light fw-bold">You have no items in your Watchlist
                                                    yet.</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-warning fs-3 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty view -->
                                <?php
                                } else {
                                ?>
                                    <!-- have products -->
                                    <div class="col-12 col-lg-12 mb-3">
                                        <div class="row">
                                            <?php

                                            for ($x = 0; $x < $watchlist_num; $x++) {
                                                $watchlist_data = $watchlist_rs->fetch_assoc();
                                                $list_id = $watchlist_data["w_id"];
                                            ?>

                                                <div class="card text-light mb-3 mx-0 mx-lg-2 col-12" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4 mt-5">

                                                            <?php


                                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $watchlist_data["product_id"] . "'");
                                                            $img_data = $img_rs->fetch_assoc();

                                                            ?>

                                                            <img src="<?php echo $img_data["img_path"]; ?>" class="img-fluid" style="height: 200px;" />
                                                        </div>
                                                        <div class=" col-md-6 justify-content-center align-items-center">
                                                            <div class="card-body">

                                                                <h5 class="card-title fs-4 fw-bold text-warning"><?php echo $watchlist_data["title"]; ?></h5>

                                                                <!-- <span class="fs-5 text-light-50">Colour : <?php echo $watchlist_data["clr_name"]; ?></span>
                                                                &nbsp;&nbsp; | &nbsp;&nbsp; -->

                                                                <span class="fs-5 text-light-50">Condition : <?php echo $watchlist_data["condition_name"]; ?></span>
                                                                <br />
                                                                <span class="fs-5 text-light-50">Price :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 text-light">Rs. <?php echo $watchlist_data["price"]; ?> .00</span>
                                                                <br />
                                                                <span class="fs-5 text-light-50">Quantity
                                                                    :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 text-light"><?php echo $watchlist_data["qty"]; ?> Items available</span>
                                                                <br />
                                                                <span class="fs-5 text-light-50">Seller :</span>

                                                                <span class="fs-5 text-light">
                                                                    <?php echo $data["fname"] . " " . $data["lname"]; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="card-body d-lg-grid">
                                                                <a href="#" onclick="addToCart(<?php echo $watchlist_data['id'] ?>);" class="btn btn-warning mb-2 "><i class="bi bi-plus-lg"></i><i class="bi bi-cart-fill"></i></a>
                                                                <a href="#" class="btn btn-danger" onclick='removeFromWatchlist(<?php echo $list_id; ?>);'>
                                                                    <i class="bi bi-trash3"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- have products -->
                                <?php
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            } else {
            ?>
                <script>
                    window.location = "home.php";
                </script>
            <?php
            }

            ?>



        </div>
        
    </div>


    <?php include "footer.php"; ?>
  

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>


</html>
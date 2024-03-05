<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css" />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="icon" href="img/Screenshot 2023-12-17 202109.png">

</head>

<body>

    <div class="container">


        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark fixed-top ">
            <div class="container">
                <a class="navbar-brand fw-bold" style="font-size: 30px; color: white;" href="home.php">Gflow Computers</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">


                    <ul class="navbar-nav me-4 mb-2 mb-lg-0 ms-auto">

                        <?php
                        session_start();

                        if (isset($_SESSION["u"])) {
                            $data = $_SESSION["u"];
                        ?>
                            <span class="text-lg-start text-warning mt-2 me-3"><b>Hi <?php echo $data["fname"]; ?></b></span>
                            <li class="nav-item me-3 mt-2">
                                <span class="text-lg-start fw-bold signout " style="cursor: pointer; color: #ffcc00 ;" onclick="signout();"> Signout </span>
                            </li>
                        <?php

                        } else {
                        ?>
                            <li class="nav-item me-3 mb-3 mt-2">
                                <a href="index.php" class="text-decoration-none fw-bold text-warning"> Sign In or Register</a>  |
                            </li>
                        <?php
                        }


                        ?>

                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class='bx bxs-cart' style="font-size: 30px; color: white;"></i></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="userProfile.php"><i class='bx bxs-user' style="font-size: 30px; color: white;"></i></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-menu' style="font-size: 30px; color: white;"></i>
                            </a>
                            <ul class="dropdown-menu">
                               
                                <li><a class="dropdown-item" href="#"><i class='bx bx-shopping-bag'></i> My Sellings</a>
                                </li>
                                <li><a class="dropdown-item" href="myProducts.php"><i class='bx bx-box'></i> My Produts</a></li>
                                <li><a class="dropdown-item" href="watchlist.php"><i class='bx bx-heart'></i> Watchlist</a></li>
                                <li><a class="dropdown-item" href="purchasingHistory.php"><i class='bx bx-history'></i> Purchase History</a>
                                </li>

                                <li><a class="dropdown-item" href="#"><i class='bx bx-message'></i> Messages</a></li>
                                
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i class='bx bx-phone-call'></i> Contact Admin</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
<?php
session_start();
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/scrollreveal"></script>

</head>

<body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg fixed-top" aria-label="Main navigation">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-light fs-2" href="#">
                    <span class="text-warning fs-2">G</span>flow Computers</a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel">
                            <span class="text-warning fs-2">G</span>flow Computers
                        </h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body pe-3  fw-bold fs-6">
                        <div class="navbar-collapse  offcanvas-collapse" id="navbarsExampleDefault">


                            <ul class="navbar-nav fs-4 text-light me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link text-light active me-2" aria-current="page" href="#">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light me-2" href="home-page.php">Contact</a>
                                </li>
                                <li class="nav-item me-2">
                                    <a class="nav-link text-light me-2" href="cart.php">Cart</a>
                                </li>
                                <!-- Example single danger button -->
                                <li class="nav-item dropdown me-2">
                                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Shop
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="userProfile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                                        <li><a class="dropdown-item" href="purchasingHistory.php">Purchase History</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </li>

                            </ul>
                            <div class="input-group">
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
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="basic_txt" />
                                <button class="btn btn-outline-warning me-2" onclick="basicSearch(0);">Search</button>
                            </div>
                        </div>

                        <div class=" offcanvas-body pe-3 text-center">

                            <?php


                            if (isset($_SESSION["u"])) {
                                $data = $_SESSION["u"];

                            ?>
                                <button class="btn btn-outline-warning me-2"><b>Hi <?php echo $data["fname"]; ?></b></button>
                                <span class="justify-content-end text-light  me-2 fs-4" style="max-height: 50px;">|</span>
                                <button class="btn btn-outline-warning me-2" type="submit" onclick="signout();">Sign Out</button>

                            <?php
                            } else {
                            ?>
                                <a href="index.php"><button class="btn btn-outline-warning" type="submit">Register or Sign In</button></a>

                            <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </nav>
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 2500,
        });
    </script>
</body>

</html>
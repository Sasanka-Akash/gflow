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
        <nav class="navbar navbar-expand-lg bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-light fs-1" href="#">
                    Gflow Computers</a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel">
                            Gflow Computers
                        </h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body pe-3 fw-bold fs-6">
                        <ul class="navbar-nav me-auto  justify-content-end  pe-3 text-center">
                            <li class="nav-item ">
                                <a class="nav-link active text-warning me-4 fs-5" aria-current="page" href="userProfile.php">Profile</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-warning me-4 fs-5" href="cart.php">Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning me-4 fs-5" href="#">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning me-4 fs-5" href="#">Contact</a>
                            </li>
                        </ul>
                        <form class="d-flex offcanvas-body pe-3 text-center" role="search">
                            <div class="col-lg-12 me-5">
                                <div class="input-group me-5">
                                    <input type="text" class="form-control fs-5" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-warning me-3" type="button" id="button-addon2">Search</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class=" offcanvas-body pe-3 text-center">

                        <?php
                        

                        if (isset($_SESSION["u"])) {
                            $data = $_SESSION["u"];

                            ?>
                            <button class="btn btn-outline-warning me-3"><b>Hi <?php echo $data["fname"]; ?></b></button>
                            <span class="justify-content-end text-light  me-3 fs-4" style="max-height: 50px;">|</span>
                            <button class="btn btn-outline-warning me-2" type="submit"  onclick="signout();">Sign Out</button>
                            
                            <?php
                        }else{
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 2500,
        });
    </script>
</body>

</html>
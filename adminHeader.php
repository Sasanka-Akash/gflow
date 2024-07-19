<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <!--font awesome-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="img/g1.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    < <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <!--css file-->
        <link rel="stylesheet" href="styles1.css" />
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-secondary fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand fs-3 fw-bold text-light" href="#"><span class=" text-warning">G</span>flow Admin Panel</a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel"><span class=" text-warning">G</span>flow Admin Panel</h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body pe-3 text-warning fw-bold fs-6">
                        <ul class="navbar-nav justify-content-end  flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active text-warning" aria-current="page" href="admindashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="manageUsers.php">User Managment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="manageProducts.php">Product Managment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="myProducts.php">Add Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="myProducts.php">Report</a>
                            </li>
                            <li class="nav-item">
                                <a href="home.php"><button class="btn btn-warning text-dark" href="#">Go to Gflow Home</button></a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>
</body>

</html>
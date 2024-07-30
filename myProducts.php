<?php

session_start();
$admin = $_SESSION["au"];

?>


<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Products | Gflow</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="img/g1.png">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles1.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">



    <link rel="icon" href="img/g1.png">

</head>

<body class="bg-dark">

    <?php include "adminHeader.php"; ?>
    <!-- <div class="container-fluid"> -->
    <div class="row mt-3">

        <!-- header -->
        <div class="col-12 bg-dark mt-4">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="row">

                        <div class="col-12 col-lg-8">
                            <div class="row text-center text-lg-start">
                                <!-- <div class="col-12 mt-0 mt-lg-4">
                                            <span class="text-white fs-2 fw-bold">
                                                <?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></span>
                                        </div> -->
                                <!-- <div class="col-12">
                                            <span class="text-white-50 fw-bold"><?php echo $email; ?></span>
                                        </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8 mt-4">
                    <div class="row">
                        <div class="col-12 col-lg-10 mt-2 my-lg-4">
                            <h1 class="offset-4 offset-lg-2 text-white fw-bold">Add Products</h1>
                        </div>
                        <div class="col-12 col-lg-2 mx-2  my-lg-4 mx-lg-0 d-grid">
                            <button class="btn btn-warning fw-bold" onclick="window.location='addProduct.php'">Add Product</button>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
        <!-- header -->




        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproduct">
                Launch demo modal
            </button> -->

        <!-- Modal -->
        <!-- <div class="container admin-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-10 mt-5">
                        <h2 class="text-center">Product Managment</h2>

                        <div class="row mt-4">
                            <div class="col-4 offset-4 d-flex justify-content-center mb-3">
                                <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#registerProductModal">Register Product</button>
                            </div>
                            <div class="col-6 offset-3 d-flex justify-content-around">
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#registerBrandModal">Add Brand</button>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#registerCategoryModal">Add Category</button>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#registerColorModal">Add Color</button>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#registerSizeModal">Add Size</button>
                            </div>
                        </div>

                        <div class="mt-4 table-responsive" id="content">

                        </div>

                    </div>
                </div>
            </div> -->


        <!-- <div class="modal fade bg-dark" id="registerProductModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header fs-5">
                        <h2>Product Register</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-2">

                            <div class="mb-2">
                                <label class="form-label">Product Image</label>
                                <img src="" id="i0" class="w-100">
                            </div>

                            

                            <input type="file" class="d-none" multiple id="imageuploader" />
                            <label for="imageuploader" class="col-12 btn btn-warning" onclick="changeProductImage();">Upload Images</label>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Product Name</label>
                            <input class="form-control" type="text" id="title">
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Product Description</label>
                            <textarea class="form-control" type="text" id="desc" rows="5"></textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Category</label>
                            <select class="form-control" id="category">
                                <option value="0">Select Category</option>

                                <?php
                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"]; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Brand</label>
                            <select class="form-control" id="brand">
                                <option value="0">Select brand</option>

                                <?php
                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                $brand_num = $brand_rs->num_rows;

                                for ($x = 0; $x < $brand_num; $x++) {
                                    $brand_data = $brand_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $brand_data["brand_id"]; ?>">
                                        <?php echo $brand_data["brand_name"]; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Model</label>
                            <select class="form-control" id="model">
                                <option value="0">Select Model</option>

                                <?php
                                $model_rs = Database::search("SELECT * FROM `model`");
                                $model_num = $model_rs->num_rows;

                                for ($x = 0; $x < $model_num; $x++) {
                                    $model_data = $model_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $model_data["model_id"]; ?>">
                                        <?php echo $model_data["model_name"]; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Color</label>
                            <select class="form-control" id="clr">
                                <option value="0">Select Color</option>
                                <?php
                                $color_rs = Database::search("SELECT * FROM `color`");
                                $color_num = $color_rs->num_rows;

                                for ($x = 0; $x < $color_num; $x++) {
                                    $color_data = $color_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $color_data["clr_id"]; ?>">
                                        <?php echo $color_data["clr_name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Add Product Quantity</label>
                            <input type="number" class="form-control" value="0" min="0" id="qty" />
                        </div>

                        <div class="mb-2">
                            <label class="form-label ">Select Product Condition</label>
                            <div class="form-check form-check-inline mx-5">
                                <input class="form-check-input" type="radio" name="c" id="b" checked />
                                <label class="form-check-label " for="b">Brandnew</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="c" id="u" />
                                <label class="form-check-label " for="u">Used</label>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Cost Per Item</label>
                            <div class="input-group mb-2 mt-2">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="cost" />
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Delivery Cost</label>
                            <div class="col-12 ">
                                <div class="row">
                                    <div class="col-12 ">
                                        <label class="form-label">Delivery cost Within Colombo</label>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="input-group mb-2 mt-2">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" id="dwc" />
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12  ">
                                        <label class="form-label">Delivery cost out of Colombo</label>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="input-group mb-2 mt-2">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" id="doc" />
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-bold" style="font-size: 20px;">Notice...</label><br />
                            <label class="form-label">
                                We are taking 5% of the product from price from every
                                product as a service charge.
                            </label>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="addProduct();">Register Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->






        <!-- body -->
        <div class="col-12 bg-secondary ">
            <div class="row mt-5">
                <!-- filter -->
                <!-- <div class="col-11 col-lg-2 mx-3 my-3 border border-warning rounded">
                            <div class="row">
                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Sort Products</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" placeholder="Search..." class="form-control" id="s" />
                                                </div>
                                                <div class="col-1 p-1">
                                                    <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="h">
                                                <label class="form-check-label" for="h">
                                                    High to low
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="l">
                                                <label class="form-check-label" for="l">
                                                    Low to high
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 80%;" />
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="b">
                                                <label class="form-check-label" for="b">
                                                    Brandnew
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-warning fw-bold" onclick="sort1(0);">Sort</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="clearSort();">Clear</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> -->
                <!-- filter -->

                <!-- product -->
                <div class="col-12 col-lg-12 mt-3 mb-3">
                    <div class="row" id="sort">

                        <div class="offset-1 col-10 text-center">
                            <div class="row justify-content-center">

                                <?php

                                $query = "SELECT * FROM `product`";
                                $pageno;

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $product_rs = Database::search($query);
                                $product_num = $product_rs->num_rows;

                                $result_per_page = 6;
                                $number_of_pages = ceil($product_num / $result_per_page); // dashama sankaya thiyed kiyl balala purn sankay vt harwim 

                                $page_results = ($pageno - 1) * $result_per_page; //inna page eka anuva kothan idan kothatad result pennane
                                $selected_rs = Database::search($query . "LIMIT " . $result_per_page . " OFFSET " . $page_results . ""); //view karan product tika view kirim

                                $selected_num = $selected_rs->num_rows;
                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();
                                ?>
                                    <!-- card -->
                                    <div class="card mb-3 mt-3 col-12 col-lg-6 bg-dark text-light">
                                        <div class="row">
                                            <div class="col-md-4 mt-4">

                                                <?php
                                                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                $product_img_data = $product_img_rs->fetch_assoc();
                                                ?>

                                                <img src="<?php echo $product_img_data["img_path"]; ?>" class="img-fluid rounded-start" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                    <span class="card-text fs-3 fw-bold text-warning"><?php echo $selected_data["price"]; ?>.00</span><br />
                                                    <span class="card-text fs-5 fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="toggle<?php echo $selected_data["id"]; ?>" onchange="changeStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_status_id"] == 2) { ?> checked <?php } ?> />
                                                        <label class="form-check-label fw-bold text-light" for="toggle<?php echo $selected_data["id"]; ?>">
                                                            <?php if ($selected_data["status_status_id"] == 1) { ?>
                                                                Make Your Product Deactive
                                                            <?php } else { ?>
                                                                Make Your Product Active
                                                            <?php } ?>
                                                        </label>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-12">
                                                            <div class="row g-1">
                                                                <div class="col-12 d-grid">
                                                                    <button class="btn btn-warning fw-bold" onclick="sendid(<?php echo $selected_data['id']; ?>);">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- card -->
                                <?php
                                }

                                ?>


                            </div>
                        </div>








                        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-md justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href=" 
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php
                                    for ($x = 1; $x <= $number_of_pages; $x++) {
                                        if ($x == $pageno) {
                                    ?>
                                            <li class="page-item active">
                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item ">
                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <li class="page-item">
                                        <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
                <!-- product -->

            </div>
        </div>
        <!-- body -->

    </div>

    <div class="col-12 text-center mt-5">
        <div class="col-12 d-none d-lg-block">
            <p style="color: white;" class="text-center">&copy; 2023 Gflow.lk || All Rights Reserved</p>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

<?php



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="img/g1.png">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles1.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

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
                                <a class="nav-link text-warning" href="manageSuppliers.php">Suppliers Managment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="manageCustomer.php">Customer Managment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="sellingHistory.php">Selling</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="#" data-bs-toggle="modal" data-bs-target="#registerProductModal">Add Product</a>
                            </li>

                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle text-warning fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Product Details Add
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#registerBrandModal" href="#">Add Brand</button></li>
                                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#registerCategoryModal" href="#">Add Category</button></li>
                                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#registerModelModal" href="#">Add Model</button></li>
                                        <!-- <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#registercolorModal" href="#">User Color</button></li> -->
                                    </ul>
                            </li>

                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle text-warning fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Reports
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="userReport.php">User Report</a></li>
                                        <li><a class="dropdown-item" href="productReport.php">Product Report</a></li>
                                        <li><a class="dropdown-item" href="suppliersReport.php">Suppliers Report</a></li>
                                        <li><a class="dropdown-item" href="customerReport.php">Customer Report</a></li>
                                    </ul>
                            </li>
                            <li class="nav-item">
                                <a href="home.php"><button class="btn btn-warning text-dark" href="#">Go to Gflow Home</button></a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>


        <div class="modal fade" id="registerBrandModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label" for="">Brand Name</label>
                        <input class="form-control" type="text" id="brandname">
                    </div>

                    <h4 class="text-center fw-bold">Brands</h4>

                    <?php

                    include "connection.php";

                    $brand_rs = Database::search("SELECT * FROM `brand`");
                    $brand_num = $brand_rs->num_rows;

                    for ($x = 0; $x < $brand_num; $x++) {
                        $brand_data = $brand_rs->fetch_assoc();

                    ?>

                        <label class="text-center" for=""><?php echo $brand_data["brand_name"]; ?></label>

                    <?php
                    }
                    ?>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" onclick="registerBrand();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="registerCategoryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label" for="">Category Name</label>
                        <input class="form-control" type="text" id="categoryName">
                    </div>

                    <h4 class="text-center fw-bold">Categorys</h4>

                    <?php



                    $category_rs = Database::search("SELECT * FROM `category`");
                    $category_num = $category_rs->num_rows;

                    for ($x = 0; $x < $category_num; $x++) {
                        $category_data = $category_rs->fetch_assoc();

                    ?>

                        <label class="text-center" for=""><?php echo $category_data["cat_name"]; ?></label>

                    <?php
                    }
                    ?>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" onclick="registerCategory();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="registerModelModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label" for="">Model Name</label>
                        <input class="form-control" type="text" id="modelname">
                    </div>

                    <h4 class="text-center fw-bold">Models</h4>

                    <?php



                    $model_rs = Database::search("SELECT * FROM `model`");
                    $model_num = $model_rs->num_rows;

                    for ($x = 0; $x < $model_num; $x++) {
                        $model_data = $model_rs->fetch_assoc();

                    ?>

                        <label class="text-center" for=""><?php echo $model_data["model_name"]; ?></label>

                    <?php
                    }
                    ?>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" onclick="registerModel();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        

        <div class="modal fade bg-dark" id="registerProductModal" tabindex="-1" aria-hidden="true">
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
                            <button type="button" class="btn btn-warning" onclick="addProduct();">Register Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <script src="script.js"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

</body>

</html>
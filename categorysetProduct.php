<?php

include "header-page.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];
    // $product = $_SESSION["p"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.model_has_brand_id,product.condition_condition_id,product.status_status_id,
    product.user_email,model.model_name AS mname,brand.brand_name AS bname FROM `product` INNER JOIN `model_has_brand`
    ON model_has_brand.id=product.model_has_brand_id  INNER JOIN `brand` ON brand.brand_id=model_has_brand.brand_brand_id
    INNER JOIN `model` ON model.model_id=model_has_brand.model_model_id 
    WHERE product.id='" . $pid . "'");

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

            <?php
            $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $pid . "'");
            $category_data1 = $category_rs->fetch_assoc();
            ?>

            <title><?php echo $category_data1["cat_name"]; ?> | Gflow</title>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <!-- or -->
            <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
            <link rel="stylesheet" href="style.css">
            <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
            <script src="https://unpkg.com/scrollreveal"></script>
            <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">


        <body class="bg">

            <div class="container-fluid">


                <div class="col-12 col-lg-12">
                    <div class="row mt-5">
                        <!-- filter -->
                        <div class=" col-10 col-lg-2 mx-3 my-3 text-light" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                            <div class="col-12 col-lg-12 py-4 rounded-3 mt-5">
                                <h2 class="text-center"><i class="bi bi-funnel-fill"></i>Filters</h2>
                                <div class="mb-2">
                                    <label class="form-label" for="">Category</label>
                                    <select class="form-select" id="category">
                                        <option value="0">Select Category</option>

                                        <?php
                                        $rs = Database::search("SELECT * FROM `category`");
                                        $num = $rs->num_rows;

                                        for ($x = 0; $x < $num; $x++) {
                                            $d = $rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($d["cat_id"]); ?>"><?php echo ($d["cat_name"]); ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="">Brand</label>
                                    <select class="form-select" id="brand">
                                        <option value="0">Select Brand</option>

                                        <?php
                                        $rs = Database::search("SELECT * FROM `brand`");
                                        $num = $rs->num_rows;

                                        for ($x = 0; $x < $num; $x++) {
                                            $d = $rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($d["brand_id"]); ?>"><?php echo ($d["brand_name"]); ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <label class="form-label" for="">Condition</label>
                                    <select class="form-select" id="condition">
                                        <option value="0">Select Condition</option>

                                        <?php
                                        $rs = Database::search("SELECT * FROM `condition`");
                                        $num = $rs->num_rows;

                                        for ($x = 0; $x < $num; $x++) {
                                            $d = $rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($d["condition_id"]); ?>"><?php echo ($d["condition_name"]); ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <label class="form-label" for="">Color</label>
                                    <select class="form-select" id="condition">
                                        <option value="0">Select Color</option>

                                        <?php
                                        $rs = Database::search("SELECT * FROM `color`");
                                        $num = $rs->num_rows;

                                        for ($x = 0; $x < $num; $x++) {
                                            $d = $rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($d["clr_id"]); ?>"><?php echo ($d["clr_name"]); ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                
                                <div class="mb-2">
                                    <label class="form-label" for="">Price Form</label>
                                    <input class="form-control" type="text" name="" id="priceFrom">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label" for="">Price To</label>
                                    <input class="form-control" type="text" name="" id="priceTo">
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-secondary" onclick="filter(1);">FITER</button>
                                </div>

                            </div>
                        </div>


                        <div class="col-12 col-lg-9">




                            <div class="row mt-5 ">
                                <?php
                                $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $pid . "'");
                                $category_data = $category_rs->fetch_assoc();
                                ?>

                                <h1 class="text-center text-warning fw-bold"><?php echo $category_data["cat_name"]; ?></h1>

                                <div class="col-12 mt-5">
                                    <div class="row justify-content-center gap-5">


                                        <?php

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`= $pid 
                                        AND `status_status_id`='1' ORDER BY `datetime_added` DESC ");

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
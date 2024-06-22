<?php

session_start();
include "connection.php";

$user = $_SESSION["u"]["email"];

$search = $_POST["s"];
$time = $_POST["t"];
$qty = $_POST["q"];
$condition = $_POST["c"];
$brand = $_POST["b"];
$category = $_POST["ca"];
// $gpu = $_POST["gpu"];

$query = "SELECT * FROM `product` WHERE `user_email`='" . $user . "'";


if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'"; //congate re asign 
}

if ($condition != "0") {
    $query .= " AND `condition_condition_id`='" . $condition . "'";
}

if ($brand != "0") {
    $query .= " AND `model_has_brand_id`='" . $brand . "'";
}

if ($category != "0") {
    $query .= " AND `category_cat_id`='" . $category . "'";
}

// if ($gpu != "0") {
//     $query .= " AND `VGA_card`='" . $gpu . "'";
// }

if ($time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY `price` DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY `price` ASC";
    }
}
if ($brand != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}
if ($category != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}
if ($condition != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}


// if ($brand !== "0" && $time != "0" && $qty = "0" ) {
//     if ($qty == "1") {
//         $query .= " , `price` DESC";
//     } else if ($qty == "2") {
//         $query .= " , `price` ASC";
//     }
// } else if ( $category == "0" && $qty != "0"  && $brand != "0") {
//     if ($qty == "1") {
//         $query .= " ORDER BY `qty` DESC";
//     } else if ($qty == "2") {
//         $query .= " ORDER BY `qty` ASC";
//     }
// }

?>


<div class="offset-1 col-10 text-center">
    <div class="row justify-content-center">

        <?php

        if ("0" != ($_POST["page"])) {
            $pageno = $_POST["page"];
        } else {
            $pageno = 1;
        }

        $product_rs = Database::search($query);
        $product_num = $product_rs->num_rows;

        $result_per_page = 6;
        $number_of_pages = ceil($product_num / $result_per_page); // dashama sankaya thiyed kiyl balala purn sankay vt harwim 

        $page_results = ($pageno - 1) * $result_per_page; //inna page eka anuva kothan idan kothatad result pennane
        $selected_rs = Database::search($query . " LIMIT " . $result_per_page . " OFFSET " . $page_results . ""); //view karan product tika view kirim

        $selected_num = $selected_rs->num_rows;
        for ($x = 0; $x < $selected_num; $x++) {
            $selected_data = $selected_rs->fetch_assoc();
        ?>
            <!-- card -->
            <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">


                <?php
                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();


                ?>

                <img src="<?php echo $product_img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 250px;" />

                <div class="card-body ms-0 m-0 text-center">
                    <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                    <span class="badge rounded-pill text-bg-info">New</span><br />
                    <span class="card-text text-primary"><?php echo $selected_data["price"]; ?> .00</span><br />

                    <?php

                    if ($selected_data["qty"] > 0) {
                    ?>
                        <span class="card-text text-warning fw-bold">In Stock</span><br />
                        <span class="card-text text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span><br /><br />
                        <a href='<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>' class="col-12 btn btn-warning">Buy Now</a>

                        <button class="col-12 btn btn-dark mt-2" onclick="addToCart(<?php echo $selected_data['id'] ?>);">
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





                    ?>



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
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="sort1(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                        } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="sort1(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item ">
                        <a class="page-link" onclick="sort1(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="sort1(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                        } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
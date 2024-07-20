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

        if ($selected_num > 0) {

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();
        ?>
                <!-- card -->
                <div class="card card-design col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">
                    <a href='<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>' class="link-dark text-decoration-none">
                        <?php
                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                        $img_data = $img_rs->fetch_assoc();
                        ?>

                        <img src="<?php echo $img_data["img_path"]; ?>" class=" card-img justify-content-center align-items-center" style="height: 250px;" />
                        <div class="card-body ms-0 m-0 text-center">
                            <h5 class="card-title fw-bold fs-6 link-light text-decoration-none"><?php echo $selected_data["title"]; ?></h5>
                            <!-- <span class="badge rounded-pill text-bg-info">New</span><br /> -->
                            <span class="fs-3 fw-bold card-text text-warning">LKR <?php echo $selected_data["price"]; ?>.00</span><br />

                            <?php

                            if ($selected_data["qty"] > 0) {
                            ?>
                                <div class="ms-4">
                                    <button class="col-12 btn Btn ms-4" onclick="addToCart(<?php echo $selected_data['id'] ?>);">
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
                <!-- card -->
            <?php
            }
        } else {
            ?>
            <div class="col-12 text-center mt-5">
                <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 150px;"></i>
                <h2 class="text-danger fw-bold">No Product</h2>
                <span class="text-muted">No matching products wre found for the search text you have entered.</span>
            </div>
        <?php
        }



        ?>


    </div>
</div>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-md justify-content-center">
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
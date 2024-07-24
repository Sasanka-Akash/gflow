<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <!-- <td>Category</td> -->
            <td>Brand</td>
            <td>Model</td>
            <td>Price</td>
            <td>Status</td>
            <!-- <td>Action</td> -->
        </tr>
    </thead>

    <tbody>

        <?php

        include "connection.php";

        $query = "SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.model_has_brand_id,product.condition_condition_id,product.status_status_id,
    product.user_email,model.model_name AS mname,brand.brand_name AS bname FROM `product` INNER JOIN `model_has_brand`
    ON model_has_brand.id=product.model_has_brand_id  INNER JOIN `brand` ON brand.brand_id=model_has_brand.brand_brand_id
    INNER JOIN `model` ON model.model_id=model_has_brand.model_model_id";

        $category_rs = Database::search("SELECT * FROM `product` INNER JOIN `category` ON category.cat_id = product.category_cat_id");
        $category_data1 = $category_rs->fetch_assoc();

        $pageno;

        if (isset($_GET["page"]) ) {
            $pageno = $_GET["page"];
            
        } else {
            $pageno = 1;
        }

        $user_rs = Database::search($query);
        $user_num = $user_rs->num_rows;

        $results_per_page = 10;
        $number_of_pages = ceil($user_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

        $selected_num = $selected_rs->num_rows;

        for ($x = 0; $x < $selected_num; $x++) {
            $selected_data = $selected_rs->fetch_assoc();

        ?>

            <tr>
                <td><?php echo ($selected_data["id"]); ?></td>
                <td><?php echo ($selected_data["title"]); ?></td>
                <!-- <td><?php echo ($category_data1["cat_name"]); ?></td> -->
                <td><?php echo ($selected_data["bname"]); ?></td>
                <td><?php echo ($selected_data["mname"]); ?></td>
                <td><?php echo ($selected_data["price"]); ?></td>
                <td>
                    <?php
                    if ($selected_data["status_status_id"] == 1) {
                    ?>
                        <button class="btn btn-sm btn-success" onclick="blockProduct(<?php echo ($selected_data['id']); ?>);">Active</button>
                    <?php
                    } else {
                    ?>
                        <button class="btn btn-sm btn-danger" onclick="blockProduct(<?php echo ($selected_data['id']); ?>);">Deactive</button>
                    <?php
                    }
                    ?>
                </td>
                <!-- <td>
                    <button class="btn btn-sm btn-light" onclick="loadProUpdateData('<?php echo ($selected_data['id']); ?>');">Edit</button>
                </td> -->

            </tr>

        <?php

        }

        ?>
    </tbody>
</table>

<nav aria-label="mt-3">
    <ul class="pagination  justify-content-center">

        <li class="page-item">
            <a class="page-link" aria-label="Previous" <?php if ($pageno > 1) { ?> onclick="loadProducts(<?php echo ($pageno - 1) ?>);" <?php }  ?>>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php
        for ($i = 1; $i <= $number_of_pages; $i++) {
            if ($i == $pageno) {
        ?>
                <li class="page-item active"><a class="page-link" onclick="loadProducts(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" onclick="loadProducts(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
        <?php
            }
        }
        ?>


        <li class="page-item">
            <a class="page-link" aria-label="Next" <?php if ($pageno < $number_of_pages) { ?> onclick="loadProducts(<?php echo ($pageno + 1) ?>);" <?php }  ?>>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

    </ul>
</nav>
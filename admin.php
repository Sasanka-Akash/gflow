<?php

session_start();
include "connection.php";

if (isset($_SESSION["au"])) {

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel | Gflow</title>

    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="img/Screenshot 2023-12-17 202109.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!--css file-->
    <link rel="stylesheet" href="styles1.css" />
  </head>

  <body>
    <section class="sidebar">
      <a href="#" class="logo">
        <img src="img/Screenshot 2023-12-17 202109.png" alt="" style="width: 60px; height: 50px;">
        <span class="text">Gflow Admin Panel</span>
      </a>

      <ul class="side-menu top">
        <li class="active">
          <a href="#" class="nav-link">
            <i class="fas fa-border-all"></i>
            <span class="text">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="manageUsers.php" class="nav-link">
            <i class='bx bxs-user'></i>
            <span class="text">Manage Users</span>
          </a>
        </li>
        <li>
          <a href="manageProducts.php" class="nav-link">
            <i class="fas fa-archive"></i>
            <span class="text">Manage Product</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <i class="fas fa-message"></i>
            <span class="text">Message</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <i class="fas fa-people-group"></i>
            <span class="text">Team</span>
          </a>
        </li>
      </ul>

      <ul class="side-menu">
        <li>
          <a href="#">
            <i class="fas fa-cog"></i>
            <span class="text">Settings</span>
          </a>
        </li>
        <li>

          <?php
          if (isset($_SESSION["au"])) {
          ?>
            <a href="#" class="logout">
              <i class="fas fa-right-from-bracket"></i>
              <span class="text">Logout</span>
            </a>
          <?php
          } else {
          ?>
        <li class="nav-item me-3 mb-3 mt-2">
          <a href="adminSignin.php" class="text-decoration-none fw-bold text-warning"> Sign In or Register</a> |
        </li>
      <?php
          }
      ?>

      </li>
      </ul>
    </section>

    <section class="content">
      <nav>
        <i class="fas fa-bars menu-btn"></i>
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
          <div class="form-input">
            <input type="search" placeholder="search..." />
            <button class="search-btn">
              <i class="fas fa-search search-icon"></i>
            </button>
          </div>
        </form>

        <!-- <input type="checkbox" hidden id="switch-mode" />
        <label for="switch-mode" class="switch-mode"></label> -->

        <a href="#" class="notification">
          <h4 class="text-white"><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
        </a>
        <!-- <a href="#" class="profile">
          <img src="profile.png" alt="" />
        </a> -->
      </nav>

      <main>
        <div class="head-title">
          <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
              <li>
                <a href="#">Dashboard</a>
              </li>
              <i class="fas fa-chevron-right"></i>
              <li>
                <a href="home.php" class="active">Home</a>
              </li>
            </ul>
          </div>

          <div class="col-12">
            <div class="row">
              <div class="col-12 col-lg-2 text-center my-3">
                <label style="color: #F1C40F; font-weight: bold; font-size: 20px; justify-content: center;" class="form-label fs-4 fw-bold ">Total Active Time</label>
              </div>
              <div style="color: #F1C40F; font-weight: bold; font-size: 20px;" class="col-12 col-lg-10 text-center my-3 ">

                <?php
                $start_date = new DateTime("2023-12-15 19:00:00"); //date time object

                $tdate = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $tdate->setTimezone($tz);
                $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                $difference = $end_date->diff($start_date);


                ?>

                <label class="form-label fs-4 fw-bold text-warning">
                  <?php
                  echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                    $difference->format('%d') . " Days " .  $difference->format('%H') . " Hours " .
                    $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                  ?>

                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-info">
          <li>
            <i class="fas fa-calendar-check"></i>
            <span class="text">
              <h3>Daily Earnings</h3>
              <?php
              $today = date("Y-m-d");
              $thismonth = date("m");
              $thisyear = date("Y");

              $a = "0";
              $b = "0";
              $c = "0";
              $d = "0";
              $e = "0";
              $f = "0";

              $invoice_rs = Database::search("SELECT * FROM `invoice`");
              $invoice_num = $invoice_rs->num_rows;

              for ($x = 0; $x < $invoice_num; $x++) {
                $invoice_data = $invoice_rs->fetch_assoc();

                $f = $f + $invoice_data["qty"]; //total qty

                $d = $invoice_data["date"];
                $splitDate = explode(" ", $d); //index array 
                $pdate = $splitDate["0"];

                if ($pdate == $today) {
                  $a = $a + $invoice_data["total"];
                  $c = $c + $invoice_data["qty"];
                }

                $splitMonth = explode("-", $pdate); //separate date as year,month & day
                $pyear = $splitMonth["0"]; //year
                $pmonth = $splitMonth["1"]; //month

                if ($pyear == $thisyear) {
                  if ($pmonth == $thismonth) {
                    $b = $b + $invoice_data["total"];
                    $e = $e + $invoice_data["qty"];
                  }
                }
              }

              ?>
              <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
            </span>
          </li>
          <li>
            <i class="fas fa-people-group"></i>
            <span class="text">
              <h3>Customers</h3>
              <?php
              $user_rs = Database::search("SELECT * FROM `user`");
              $user_num = $user_rs->num_rows;
              ?>
              <span class="fs-5"><?php echo $user_num; ?> Members</span>
            </span>
          </li>
          <li>
            <i class="fas fa-dollar-sign"></i>
            <span class="text">
              <h3>Today Sellings</h3>
              <span class="fs-5"><?php echo $c; ?> Items</span>
            </span>
          </li>
        </div>

        <div class="box-info">
          <li>
            <i class="fas fa-calendar-check"></i>
            <span class="text">
              <h3>Monthly Earnings</h3>
              <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
            </span>
          </li>
          <li>
            <i class="fas fa-people-group"></i>
            <span class="text">
              <h3>Monthly Sellings</h3>
              <span class="fs-5"><?php echo $e; ?> Items</span>
            </span>
          </li>
          <li>
            <i class="fas fa-dollar-sign"></i>
            <span class="text">
              <h3>Total Sellings</h3>
              <span class="fs-5"><?php echo $f; ?> Items</span>
            </span>
          </li>
        </div>

        <div class="table-data">
          <div class="order">
            <div class="head">
              <h3>Recent Orders</h3>
              <i class="fas fa-search"></i>
              <i class="fas fa-filter"></i>
            </div>

            <table>
              <thead>
                <tr>
                  <th>User</th>
                  <th>Order Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS`value_occurence` FROM `invoice`
                WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence` DESC "); //ad dws thul wadiyen sell una product eka arn denv

                $freq_num = $freq_rs->num_rows;

                for ($x = 0; $x < $freq_num; $x++) {

                  $freq_data = $freq_rs->fetch_assoc();

                  $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                  product.id=product_img.product_id INNER JOIN `user` ON product.user_email=user.email
                  INNER JOIN `profile_img` ON user.email=profile_img.user_email WHERE `id`='" . $freq_data["product_id"] . "'");

                  $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE `product_id`='" . $freq_data["product_id"] . "'
                  AND `date` LIKE '%" . $today . "%'");
                  $qty_data = $qty_rs->fetch_assoc();

                  $produc_data = $product_rs->fetch_assoc();
                ?>
                  <tr>
                    <td>

                      <?php
                      $seller_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `user` ON
                  invoice.user_email=user.email WHERE `product_id`='" . $freq_data["product_id"] . "'");
                      $seller_data = $seller_rs->fetch_assoc();

                      $seller_img = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON 
                  user.email=profile_img.user_email WHERE `user_email`='" . $seller_data["email"] . "'");
                      $seller_img_data = $seller_img->fetch_assoc();
                      ?>

                      <img src="<?php echo $seller_img_data["path"]; ?>" alt="" />
                      <p><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></p>
                    </td>
                    <td><?php echo $seller_data["date"]; ?></td>
                    <td><span class="status pending"><?php echo $seller_data["email"]; ?></span></td>
                  </tr>
                <?php
                }
                ?>

              </tbody>
            </table>
          </div>

          <div class="todo">
            <div class="head">
              <h3>Mostly Sold Products</h3>
              <i class="fas fa-plus"></i>
              <i class="fas fa-filter"></i>
            </div>

            <ul class="todo-list">

              <?php

              $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS`value_occurence` FROM `invoice`
              WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence` DESC "); //ad dws thul wadiyen sell una product eka arn denv

              $freq_num = $freq_rs->num_rows;

              for ($x = 0; $x < $freq_num; $x++) {

                $freq_data = $freq_rs->fetch_assoc();

                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                product.id=product_img.product_id INNER JOIN `user` ON product.user_email=user.email
                INNER JOIN `profile_img` ON user.email=profile_img.user_email WHERE `id`='" . $freq_data["product_id"] . "'");

                $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE `product_id`='" . $freq_data["product_id"] . "'
                AND `date` LIKE '%" . $today . "%'");
                $qty_data = $qty_rs->fetch_assoc();

                $produc_data = $product_rs->fetch_assoc();

              ?>
                <li class="not-completed">
                  <img src="<?php echo $produc_data["img_path"]; ?>" class="img-fluid rounded-top" style="height: 50px;" />
                  <span class="fs-5 fw-bold"><?php echo $produc_data["title"]; ?></span><br />
                  <span class="fs-6"><?php echo $qty_data["qty_total"]; ?> items</span><br />
                  <span class="fs-6">Rs. <?php echo $qty_data["qty_total"] * $produc_data["price"]; ?> .00</span>
                  <i class="fas fa-ellipsis-vertical"></i>
                </li>
                <?php

                ?>

            <?php

              }
            } else {
              echo ("You are not a valid user.");
            }

            ?>

            </ul>
          </div>
        </div>
      </main>
    </section>
    <script src="app.js"></script>
  </body>

  </html>
  <?php



  ?>
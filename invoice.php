<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice | Gflow</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="img/g1.png">
</head>

<body class="mt-2" style="background-color: #f7f7ff;">
    



    <div class="container-fluid">
        <div class="row">
            <?php include "header.php";


            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];

            ?>
                <div class="col-12  mt-5">
                    <hr />
                </div>

                <div class="col-12  mt-5 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                    <button class="btn btn-danger me-2"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>

                <div class="col-12  mt-5">
                    <hr />
                </div>

                <div class="col-12 mt-5" id="page">
                    <div class="row">

                        <!-- <div class="col-6">
                            <div class="ms-5 logo"></div>
                        </div> -->

                        <div class="col-12 text-center">
                            <div class="row">
                                <div class="col-12 fs-1 text-end text-center ">
                                    <ul class="text">
                                        <li class="text-warning fs-5 fw-bold mt-4"><h1> G </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> f </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> l </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> o </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> w </h1></li>
                                      
                                        <li class="fs-5 fw-bold mt-4"><h1> - </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> C </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> o </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> m </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> p </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> u </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> t </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> e </h1></li>
                                        <li class="fs-5 fw-bold mt-4"><h1> r </h1></li>
                                        
                                    </ul>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 " />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">

                                <?php
                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                $address_data = $address_rs->fetch_assoc();
                                ?>

                                <div class="col-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>
                                    <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"];  ?></h2>
                                    <span><?php echo $address_data["line1"] . " " . $address_data["line2"];  ?></span><br />
                                    <span><?php echo $umail; ?></span>
                                </div>

                                <?php

                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                $invoice_data =  $invoice_rs->fetch_assoc();

                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-warning">INVOICE <?php echo $invoice_data["invoice_id"]; ?></h1>
                                    <span class="fw-bold">Data & Time of Invoice : </span>&nbsp;
                                    <span class="fw-bold"><?php echo $invoice_data["date"]; ?></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table ">
                                <thead>
                                    <tr class="border border-1 border-secondary">
                                        <th>#</th>
                                        <th>Order ID & Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 72px;">
                                        <td class="bg-warning text-white fs-3"><?php echo $invoice_data["invoice_id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-black text-decoration-underline p-2"><?php echo $oid; ?></span><br />

                                            <?php

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            ?>

                                            <span class="fw-bold text-warning fs-3 p-2"><?php echo $product_data["title"];  ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-3 text-black">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                        <td class="fw-bold fs-6 text-end pt-3"><?php echo $invoice_data["qty"]; ?></td>
                                        <td class="fw-bold fs-6 text-end pt-3 text-black">Rs. <?php echo $invoice_data["total"]; ?> .00</td>
                                    </tr>
                                </tbody>
                                <tfoot>

                                    <?php

                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $address_data["city_city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $delivery = 0;

                                    if ($city_data["district_district_id"] == 1) {
                                        $delivery = $product_data["delivery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delivery_fee_other"];
                                    }

                                    $t = $invoice_data["total"];
                                    $g = $t - $delivery;

                                    ?>


                                </tfoot>
                            </table>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-8 text-center mt-5">
                                    <span class="fs-1 fw-bold text-warning">Thank You !</span>
                                </div>
                                <div class="col-12 col-lg-4">

                                    <div class="row">

                                        <div class="col-6 mb-3">
                                            <span class="fs-6 fw-bold">SUBTOTAL</span>
                                        </div>

                                        <div class="col-6 text-end mb-3">
                                            <span class="fs-6 fw-bold">Rs. <?php echo $g; ?> .00</span>
                                        </div>

                                        <div class="col-6">
                                            <span class="fs-6 fw-bold">Delivery Fee</span>
                                        </div>

                                        <div class="col-6 text-end">
                                            <span class="fs-6 fw-bold">Rs. <?php echo $delivery; ?> .00</span>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <hr />
                                        </div>

                                        <div class="col-6 mt-2">
                                            <span class="fs-4 fw-bold">GRAND TOTAL</span>
                                        </div>

                                        <div class="col-6 mt-2 text-end">
                                            <span class="fs-4 fw-bold">Rs. <?php echo $t; ?> .00</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-4 text-center " style="margin-top: -100px;">
                            <span class="fs-1 fw-bold text-warning">Thank You !</span>

                        </div> -->

                    <div class="col-12 mt-3 mb-3 border-0 border-start border-5 border-warning rounded" style="background-color: #FEEE9A;">
                        <div class="row">
                            <div class="col-12 mt-3 mb-3">
                                <label class="form-label fs-5 fw-bold" style="margin-left: 20px;">NOTICE : </label>
                                <br />
                                <label class="form-label fs-6" style="margin-left: 20px;">Purchased items can return befor 7 days of Delivery.
                                    All items in good condition.
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="border border-1 " />
                    </div>

                    <div class="col-12 text-center mb-3">
                        <label class="form-label fs-5 text-black fw-bold">
                            Invoice was created on a computer and is valid without the Signature and Seal.
                        </label>
                    </div>

                    <div class="col-12 text-center mb-5 mt-5">
                        <p class="form-label fs-8 text-black-50 fw-bold">
                            Maradana, Colombo 10, Sri Lanka. Tel:+94112 555448 , Email: gflow@gmail.com
                        </p>
            
                    </div>


                </div>





        </div>
    <?php

            }

    ?>




    </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
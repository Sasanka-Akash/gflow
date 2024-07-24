<?php

session_start();

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products Managment | Gflow </title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="img/g1.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </head>

    <body onload="loadProducts(1);">

        <!-- admin header -->
        <?php include "adminHeader.php" ?>

        <div class="container admin-body mt-5 ">
            <div class="row mt-5 d-flex justify-content-center">
                <div class="col-10 mt-5">
                    <h2 class="text-center">Products Managment</h2>



                    <div class="mt-4 table-responsive" id="content">

                    </div>

                </div>
            </div>
        </div>

        


        <script src="script.js"></script>
    </body>

    </html>

<?php

} else {
    header("Location: adminSignin.php");
}

?>
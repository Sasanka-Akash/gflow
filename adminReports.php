<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | Online Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="image/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

</head>

<body class="bg-dark">
    <?php include "adminHeader.php" ?>


    <div class="container admin-body ">
        <div class="row vh-100 d-flex align-items-center">

            <div class="col-4">
                <a href="userReport.php" class="btn btn-outline-warning w-100" >User Reports</a>
            </div>

            <div class="col-4">
                <a href="productReport.php" class="btn btn-outline-warning w-100">Products Reports</a>
            </div>

            <div class="col-4">
                <a href="#" class="btn btn-outline-warning w-100">Stock Reports</a>
            </div>

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Contact | Gflow</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="icon" href="img/g1.png">

</head>

<body class="bg">
    <div class="spinner-wrapper">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <?php include "header-page.php"; ?>

    <div class="container-fluid mt-5">


        <div class="row mt-5">
            <h2 class="mt-5 text-warning text-center fs-1 fw-bold"><i class="bi bi-person-lines-fill fs-1"></i> Contact</h2>
        </div>
        <iframe class="w-100 mt-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0194594794643!2d144.96305781564814!3d-37.81627974274248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf57721db0217f82d!2sFederation+Square!5e0!3m2!1sen!2sau!4v1464763199766" width="600" height="400" frameborder="0" style="border:0" allowfullscreen>
        </iframe>
    </div>
    <div class="container">
        <div class="col-lg-12">
            <div class="row">
                <div class="row mt-2 mb-4 fs-1">
                    <h1 class="justify-content-center d-flex text-light fw-bold fs-2"><i class="bi bi-envelope-open-fill fs-2 me-2"></i> Get In Touch</h1>
                </div>
                <div class="col-lg-6">
                    <div class="mb-1">
                        <label for="name" class="form-label text-light">Your Name</label>
                        <input type="email" class="form-control" id="name" placeholder="Name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-1">
                        <label for="email" class="form-label text-light">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-1">
                        <label for="mobile" class="form-label text-light"> Contact Number</label>
                        <input type="email" class="form-control" id="mobile" placeholder="0775424390">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-1">
                        <label for="prod_name" class="form-label text-light">Subject</label>
                        <input type="email" class="form-control" id="prod_name" placeholder="Product Name">
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="comment" class="form-label text-light">Inquiry | Comments</label>
                        <textarea class="form-control" id="comment" rows="8" placeholder="Inquiry | Comments"></textarea>
                    </div>
                </div>

                <div class="d-grid mb-4 d-flex justify-content-center align-items-center">
                    <button class="btn btn-warning" type="Submit" onclick="contactSubmit();">Submit</button>
                </div>

            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
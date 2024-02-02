<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/Screenshot 2023-12-17 202109.png">
    <title>Gflow</title>
</head>

<body style="background-image: url(img/bgpc.webp); background-size: cover;">

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background-image: url(img/photo-1624705002806-5d72df19c3ad.avif); background-size: cover;">
                <div class="featured-image mb-3">
                    <img src="img/Screenshot 2023-12-17 202109.png" class="img-fluid" style="width: 250px; border-radius: 50px; margin-top: 70px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Gflow Computers</p>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box d-none" id="signInBox">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Hello,Sign In</h2>
                        <p>Hi Welcome to Gflow Computers.</p>
                    </div>

                    <!--erro-veiw-->
                    <div class="col-12 d-none" id="msgdiv1">
                        <div class="alert alert-danger" role="alert" id="msg1">
                        </div>
                    </div>
                    <!--erro-veiw-->

                    <?php
                    $email = "";
                    $password = "";

                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }
                    ?>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" id="email2" value="<?php echo $email; ?>">
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" id="password2" value="<?php echo $password; ?>">
                    </div>
                    <div class="input-group mb-5 d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberme">
                            <label for="formCheck" class="form-check-label text-secondary"><small>Remember
                                    Me</small></label>
                        </div>
                        <div class="forgot">
                            <small><a href="#" onclick="fgpassword();">Forgot Password?</a></small>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-primary w-100 fs-6" onclick="signIn();">Sign In</button>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-light w-100 fs-6"><img src="images/google.png" style="width:20px" class="me-2"><small>Sign In with Google</small></button>
                    </div>
                    <div class="row" onclick="changeView();">
                        <small>Don't have account? <a href="#">Sign Up</a></small>
                    </div>
                    <div class="row" onclick="changeView();">
                        <small>Go to Admin Login <a href="adminSignin.php">Log In</a></small>
                    </div>
                </div>
            </div>


            <!--model-->
            <div class="modal" tabindex="-1" id="fpmodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        

                        <div class="modal-body">

                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Pasword</label>
                                    <div class="input-group mb-3">
                                        <input type="Password" class="form-control" id="np" />
                                        <button id="npb" class="btn btn-outline-secondary" type="button" onclick="showPassword1();">Show</button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Pasword</label>
                                    <div class="input-group mb-3">
                                        <input type="Password" class="form-control" id="rnp" />
                                        <button id="rnpb" class="btn btn-outline-secondary" type="button" onclick="showPassword2();">Show</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vcode" />
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--model-->


            <div class="col-md-6 right-box" id="signUpBox">
                <div class="row align-items-center">
                    <div class="header-text mb-3">
                        <h2>Hello,Sign Up</h2>
                        <p>Create a New Account</p>
                    </div>

                    <!--erro-veiw-->
                    <div class="col-12 d-none" id="msgdiv">
                        <div class="alert alert-danger" role="alert" id="msg">
                        </div>
                    </div>
                    <!--erro-veiw-->

                    <div class="input-group mb-2">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="First Name" id="fname" />
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Last Name" id="lname" />
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email Address" id="email" />
                    </div>
                    <div class="input-group mb-2">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" id="password" />
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Mobile" id="mobile" />
                    </div>
                    <div class="input-group mb-4">
                        <label class="form-control form-control-lg bg-light fs-6">Gender</label>
                        <select class="form-control" id="gender">

                            <?php

                            $rs = Database::search("SELECT * FROM `gender`");
                            $num = $rs->num_rows;

                            for ($x = 0; $x < $num; $x++) {
                                $data = $rs->fetch_assoc();
                            ?>

                                <option value="<?php echo $data["gender_id"]; ?>">
                                    <?php echo $data["gender_name"]; ?>
                                </option>

                            <?php
                            }

                            ?>

                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-primary w-100 fs-6" onclick="signUp();">Sign Up</button>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-light w-100 fs-6" onclick="changeView();">
                            <small>Already have an account? Sign In</small></button>
                    </div>

                </div>
            </div>

        </div>
        <!-- footer -->
        <div class="col-12 fixed-bottom d-none d-lg-block">
            <p class="text-center">&copy; 2023 Gflow.lk || All Rights Reserved</p>
        </div>
        <!-- footer -->
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>


</body>

</html>
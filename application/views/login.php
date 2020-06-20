<!DOCTYPE html>
<html lang="zxx" class="js">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="images/favicon.png">
        <!-- Site Title  -->
        <title>MyWallet - Login</title>
        <link rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor.css">
        
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="assets/css/style49f7.css" id="layoutstyle">
        
    </head>
    <body class="page-ath">
        <div class="page-ath-wrap">
            <div class="page-ath-content">

                <?php


                     
                        if ($this->session->flashdata('error')) {
                            echo'
                            <div class="alert alert-danger-alt alert-dismissible fade show">
                                <p class="text-center">'.$this->session->flashdata('error').'</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>';
                        }                     
                    ?>

                                   
                <div class="page-ath-form">

                	<div class="page-ath-header">
                    <a href="" class="page-ath-logo">
                        <img src="assets/images/logo.png" alt="logo">
                    </a>
                </div>
                <br>
                <br>

                    <form action="login" method="post" autocomplete="off">
                        <div class="input-item">
                            <input type="text" placeholder="Your Email" class="input-bordered" name="username" required="">
                        </div>
                        <div class="input-item">
                            <input type="password" placeholder="Password" class="input-bordered" name="password" required="">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            
                            <div>
                                <a href="forgot.html">Forgot password?</a>
                                <div class="gaps-2x"></div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block">Sign In</button>
                    </form>

                    
                    <div class="gaps-2x"></div>
                    <div class="gaps-2x"></div>
                    
                </div>

            </div>
            
        </div>
        <!-- JavaScript (include all script here) -->

        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/toastr.min.js"></script>
        <script src="assets/js/script.js"></script>
        <script src="assets/js/custom.js"></script>
    
        </body>
    
</html>

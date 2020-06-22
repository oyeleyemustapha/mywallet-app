<?php


echo'
<!DOCTYPE html>
<html>
      <head>
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="assets/images/favicon.png">
        <title>MyWallet - '.$pageTitle.'</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/sweet-alert2/sweetalert2.css">
        <link rel="stylesheet" href="assets/DataTables/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="assets/css/style.css" id="layoutstyle">
    </head>
    <body class="page-user">
        <div class="topbar-wrap">
            <div class="topbar is-sticky">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <ul class="topbar-nav d-lg-none">
                            <li class="topbar-nav-item relative">
                                <a class="toggle-nav" href="#">
                                    <div class="toggle-icon">
                                        <span class="toggle-line"></span>
                                        <span class="toggle-line"></span>
                                        <span class="toggle-line"></span>
                                        <span class="toggle-line"></span>
                                    </div>
                                </a>
                            </li>
                            <!-- .topbar-nav-item -->
                        </ul>
                        <!-- .topbar-nav -->
                        <a class="topbar-logo" href="'.base_url().'">
                            <img src="assets/images/logo-light2x.png">
                        </a>
                        <ul class="topbar-nav">
                            <li class="topbar-nav-item relative">
                                <span class="user-welcome d-none d-lg-inline-block">Welcome! '.$userInfo->NAME.'</span>
                                <a class="toggle-tigger user-thumb" href="#">
                                    <i class="fa fa-user"></i>
                                </a>
                                <div class="toggle-class dropdown-content dropdown-content-right dropdown-arrow-right user-dropdown">
                                    <div class="user-status">
                                        <h6 class="user-status-title">Wallet balance</h6>
                                        <div class="user-status-balance">
                                            &#8358; '.number_format($userInfo->WALLET_BALANCE).'
                                        </div>
                                    </div>
                                    <ul class="user-links">
                                        <li>
                                            <a href="'.base_url('profile').'">
                                                <i class="ti ti-id-badge"></i>
                                                My Profile
                                            </a>
                                        </li>
                                        
                                    </ul>
                                    <ul class="user-links bg-light">
                                        <li>
                                            <a href="'.base_url('logout').'">
                                                <i class="ti ti-power-off"></i>
                                                Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- .topbar-nav-item -->
                        </ul>
                        <!-- .topbar-nav -->
                    </div>
                </div>
                <!-- .container -->
            </div>
            <!-- .topbar -->
            <div class="navbar">
                <div class="container">
                    <div class="navbar-innr">
                        <ul class="navbar-menu">
                            <li>
                                <a href="'.base_url('dashboard').'">
                                    <i class="fa fa-home fa-fw"></i>&nbsp;&nbsp; Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="'.base_url('wallet').'">
                                    <i class="fa fa-square fa-fw"></i>&nbsp;&nbsp;Wallet
                                </a>
                            </li>
                            
                            <li>
                                <a href="'.base_url('transactions').'">
                                    <i class="fa fa-money fa-fw"></i>&nbsp;&nbsp;
                                    Transactions
                                </a>
                            </li>

                            <li>
                                <a href="'.base_url("transfer").'">
                                    <em class="ikon ikon-transactions"></em>
                                    Transfer
                                </a>
                            </li>
                            <li>
                                <a href="'.base_url('fund').'">
                                    <em class="fa fa-plus"></em> &nbsp; &nbsp;
                                    Fund Wallet
                                </a>
                            </li>
                            
                        </ul>
                        <ul class="navbar-btns">
                            <li>
                                <a href="'.base_url('logout').'" class="btn btn-sm btn-outline btn-light">
                                    <span>Log Out</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- .navbar-innr -->
                </div>
                <!-- .container -->
            </div>
            <!-- .navbar -->
        </div>
        <!-- .topbar-wrap -->



';



?>
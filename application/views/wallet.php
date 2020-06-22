        <div class="page-content">
            <div class="container">
                <div class="row">

                    
                    <div class="col-lg-12 mt-5">
                        
                        <div class="token-information card card-full-height">
                            <div class="row no-gutters height-100">
                                <div class="col-md-6 text-center">
                                    <div class="token-info">
                                        <img class="token-info-icon" src="assets/images/favicon.png" alt="logo-sm">
                                        <div class="gaps-2x"></div>
                                        <h1 class="token-info-head text-light">&#8358; <?php echo number_format($wallet->BALANCE) ?></h1>
                                        <h5 class="token-info-sub">Wallet Balance</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="token-info bdr-tl">
                                        <div>
                                        	<span>Wallet Number</span>
                                            <h2><?php echo $wallet->WALLET_NO ?></h2>
                                            <p>Date Created : <?php echo date('F d, Y', strtotime($wallet->DATE_CREATED)); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .card -->
                    </div>
                    <!-- .col -->
                    
                </div>
                <!-- .row -->
                <!-- .row -->
            </div>
            <!-- .container -->
        </div>
        <!-- .page-content -->
       
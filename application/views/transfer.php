        <div class="page-content">
            <div class="container">
                <div class="row">

                    <!-- .col -->
                    <div class="col-lg-12 mt-5">
                        <div class="token-information card card-full-height">
                            <div class="row no-gutters height-100">
                                <div class="col-md-6 text-center">
                                    <div class="token-info">
                                        <img class="token-info-icon" src="assets/images/favicon.png" alt="logo-sm">
                                        <div class="gaps-2x"></div>
                                        <h1 class="token-info-head text-light">&#8358; <?php echo number_format($userInfo->WALLET_BALANCE) ?></h1>
                                        <h5 class="token-info-sub">Wallet Balance</h5>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="token-info bdr-tl">
                                        <div>
                                        	<button class="btn btn-primary btn-lg"  data-toggle="modal" href='#modal-id'>Transfer</button>
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
       



<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <br>
                <div class="mt-3">


                    <form method="post" id="transferForm">
                        <input type="hidden" name="wallet_balance" value="<?php echo $userInfo->WALLET_BALANCE; ?>" required>
                        <input type="hidden" name="sender" value="<?php echo $userInfo->WALLET_NO; ?>" required>

                        <div class="form-group">
                        <label>Wallet Number</label>
                        <input type="text" name="reciever" required="" class="form-control form-control-lg wallet">
                        </div>

                        <div class="form-group">
                        <label>Amount</label>
                        <span class="notice"></span>
                        <input type="number" name="amount" required="" class="form-control form-control-lg amount" data-wallet-balance="<?php echo $userInfo->WALLET_BALANCE; ?>">
                    </div>
                        <button class="btn btn-primary btn-lg">Send</button>

                    </form>
                    
                </div>
                
            </div>
           
        </div>
    </div>
</div>
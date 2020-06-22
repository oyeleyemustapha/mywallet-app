        <div class="page-content">
            <div class="container">
                <div class="row">

                    
                    <div class="col-lg-12">
                        <div class="token-transaction card card-full-height">
                            <div class="card-innr">


                                <div class="col-lg-8 offset-lg-2 p-5">

                                    <p class="text-center"><img src="assets/images/paystack.png"></p>
                                    <form method="post" id="fundWallet">

                                        

                                        <input type="hidden" id="name" name="name" value="<?php echo $userInfo->NAME; ?>" required="">
                                        <input type="hidden" id="emailAddress" name="email" value="<?php echo $userInfo->EMAIL; ?>" required>
                                        <input type="hidden" id="ref_no" name="ref_no" value="<?php echo uniqid(); ?>" required>
                                        <input type="hidden" id="user_no" name="user_no" value="<?php echo $userInfo->USER_NO; ?>" required>
                                        <input type="hidden" id="wallet_no" name="wallet_no" value="<?php echo $userInfo->WALLET_NO; ?>" required>
                                        
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="number" id="amount" name="amount" class="form-control form-control-lg" required>
                                        </div>

                                        <button class="btn btn-primary payButton">Pay</button>
                                    </form>


                                </div>
                                    
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- .row -->
                <!-- .row -->
            </div>
            <!-- .container -->
        </div>
        <!-- .page-content -->




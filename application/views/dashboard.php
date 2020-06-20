        <div class="page-content">
            <div class="container">
                <div class="row">

                    <!-- .col -->
                    <div class="col-lg-12">
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
                                        	<span>Wallet Number</span>
                                            <h2><?php echo $userInfo->WALLET_NO ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .card -->
                    </div>
                    <!-- .col -->
                    <div class="col-lg-12">
                        <div class="token-transaction card card-full-height">
                            <div class="card-innr">
                                <div class="card-head has-aside">
                                    <h4 class="card-title">Recent Transactions</h4>
                                    <div class="card-opt">
                                        <a href="transactions" class="link ucap">
                                            View ALL <em class="fas fa-angle-right ml-2"></em>
                                        </a>
                                    </div>
                                </div>



                                <?php 
                                    


                                    if($transactions){

                                        echo'
                                             <table class="table tnx-table">
                                                <thead>
                                                    <tr>
                                                        <th>Transaction ID</th>
                                                        <th>Amount</th>
                                                        <th class="d-none d-sm-table-cell tnx-date">Date</th>
                                                        <th class="tnx-type">
                                                            <div class="tnx-type-text"></div>
                                                        </th>
                                                    </tr>
                                                    <!-- tr -->
                                                </thead>
                                                <!-- thead -->
                                                <tbody>
                                        ';

                                    
                                        foreach ($transactions as $transaction) {

                                            


                                            

                                            switch ($transaction->TYPE) {
                                                case 'Credit':
                                                    $type='<span class="tnx-type-md badge badge-outline badge-success badge-md">Credit</span>';
                                                    break;
                                                case 'Debit':
                                                    $type='<span class="tnx-type-md badge badge-outline badge-warning badge-md">Debit</span>';
                                                    break;
                                                
                                                case 'Refund':
                                                    $type='<span class="tnx-type-md badge badge-outline badge-info badge-md"></span>';
                                                    break;
                                                
                                            }
                                            echo'

                                                <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="data-state data-state-approved"></div>
                                                    <span class="lead">'.$transaction->REF_NUMBER.'</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span>
                                                    <span class="lead">&#8358; '.number_format($transaction->AMOUNT).'</span>
                                                    
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell tnx-date">
                                                <span class="sub sub-s2">'.date('F d, Y h:i:s a', strtotime($transaction->DATE)).'</span>
                                            </td>
                                            <td class="tnx-type">
                                                '.$type.'
                                            </td>
                                        </tr>




                                            ';
                                            
                                        }





                                        echo'
                                                </tbody>
                                                <!-- tbody -->
                                            </table>
                                            <!-- .table -->
                                        ';

                                                
                                    }


                                ?>
                               

                                        
                                        
                                       
                                    
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
       
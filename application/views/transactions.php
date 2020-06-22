        <div class="page-content">
            <div class="container">
                <div class="row">

                    
                    <div class="col-lg-12">
                        <div class="token-transaction card card-full-height">
                            <div class="card-innr">
                                <div class="card-head has-aside">
                                    <h4 class="card-title">Transactions</h4>
                                    
                                </div>
                                <div class="table-responsive">



                                <?php 
                                    


                                    if($transactions){



                                        echo'
                                             <table class="table tnx-table transactionTable">
                                                <thead>
                                                    <tr>
                                                        <th>Transaction ID</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th>
                                                            
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
                                                   <a href="#" class="getInfo" data-transaction="'.$transaction->REF_NUMBER.'"> <span class="lead">'.$transaction->REF_NUMBER.'</span></a>
                                                </div>
                                            </td>
                                            <td>
                                                <span>
                                                    <span class="lead">&#8358; '.number_format($transaction->AMOUNT).'</span>
                                                    
                                                </span>
                                            </td>
                                            <td class="tnx-date">
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
                                    else{

    echo'<div class="alert alert-secondary-alt"><h2 class="text-center" style="color:#fff;"><i class="fa fa-exclamation-triangle fa-3x"></i><br>No record found</h2></div>';
}



                                ?>
                               

                                        
                                        
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



<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                        
            </div>
            
        </div>
    </div>
</div>
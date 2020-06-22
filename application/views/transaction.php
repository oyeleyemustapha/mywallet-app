<?php
if($details){

switch ($details->TYPE) {
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

<div class="content-area">
                            <div class="card-head d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Transaction Details</h4>
                            </div>
                            
                            <ul class="data-details-list">
                            <li>
                                    <div class="data-details-head">Transaction ID</div>
                                    <div class="data-details-des">
                                        <strong>'.$details->REF_NUMBER.'</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="data-details-head">Transaction Date</div>
                                    <div class="data-details-des">
                                        <strong>'.date('F d, Y H:i:s a', strtotime($details->DATE)).'</strong>
                                    </div>
                                </li>
                                <!-- li -->
                                <li>
                                    <div class="data-details-head">Transaction Type</div>
                                    <div class="data-details-des">
                                        '.$type.'
                                    </div>
                                </li>
                                <!-- li -->
                                <li>
                                    <div class="data-details-head">Transaction Amount</div>
                                    <div class="data-details-des">
                                        <strong>&#8358; '.number_format($details->AMOUNT).'</strong>
                                    </div>
                                </li>
                                <!-- li -->
                                <li>
                                    <div class="data-details-head">Description</div>
                                    <div class="data-details-des">
                                        <span>'.$details->DESCRIPTION.'</span>
                                        <span></span>
                                    </div>
                                </li>
                                
                            </ul>
                           
                            <!-- .data-details -->
                        </div>
                




';
}
else{

    echo'<div class="alert alert-secondary-alt"><h2 class="text-center" style="color:#fff;"><i class="fa fa-exclamation-triangle fa-3x"></i><br>No record found</h2></div>';
}
?>
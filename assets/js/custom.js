$(document).ready(function(){



if(location.host=='localhost'){
    var base_url=location.protocol+"//"+location.host+"/mywallet/";
  }
  else{
    var base_url=location.protocol+"//"+location.host+"/mywallet/";
  }



  function alerter_success(msg, callback=''){
    swal({
        title: "Successful",
        html: msg,
        type: 'success',
        timer: 3000,
        showCancelButton: false,
        showConfirmButton: false,
        onClose:function(){
            if(callback!=''){
                callback();
            }
            
        }
    }) ;
  }


   function alerter_warning(msg){
    swal({
        title: "Error",
        html: msg,
        type: 'warning',
        showCancelButton: false,
        showConfirmButton: false,
    }) ;
  }


    $(document).ajaxSend(function(event, xhr, settings) {$(".preloader").fadeIn();});
    $(document).ajaxComplete(function(event, xhr, settings) {$(".preloader").fadeOut();});


 

//UPDATE PROFILE
$('#updateProfile').submit(function(){
    $.post( 
        base_url+"update-profile", 
        $(this).serialize(), 
        function(data){

            
            if(data=='Your profile has been updated.'){
                alerter_success(data);
            }
            else{
                alerter_warning(data);
            }  
        }
    );  
    return false;    
});



//UPDATE PASSWORD
$('#updatePassword').submit(function(){
    $.post( 
        base_url+"update-password", 
        $(this).serialize(), 
        function(data){
            if(data=='Your password has been updated.'){
                alerter_success(data);
            }
            else{
                alerter_warning(data);
            }  
        }
    );  
    return false;    
});


//TRANSFER FUND
$('#transferForm').submit(function(){
    $.post( 
        base_url+"process-transfer", 
        $(this).serialize(), 
        function(data){
            if(data=='Transfer successful.'){
                $('#transferForm')[0].reset();
                $('modal-id').modal('hide');
                alerter_success(data,  function(){location.reload()});
            }
            else{
                alerter_warning(data);
            }  
        }
    );  
    return false;    
});





$('.transactionTable').DataTable({
    "lengthChange": false,
    "order": [2, 'desc'],
    "drawCallback": function(settings) {
        $('.getInfo').click(function(){
            $.post( 
                base_url+"transaction", 
                {transaction_id:$(this).attr('data-transaction')}, 
                function(data){

                    $('#modal-id').modal('show');
                    $('#modal-id .modal-body').html(data);
                      
                }
            );
        });
    }

})



//CHECK TO SEE IF TRANSFEER AMOUNT IS NOT GREATER THAN WALLET BALANCE
$('.amount').keyup(function(){
     let wallet_balance= $(this).attr('data-wallet-balance');
     let transfer_amount=Number($(this).val());
     if(transfer_amount>10){
        if(transfer_amount%10 !=0){
           $('.notice').text('Only multiple of 10 is allowed');
            $(this).val(''); 
         }

         if(transfer_amount>wallet_balance){
            $('.notice').text('Amount is greater than your wallet balance');
            $(this).val('');
         }
     }

     
});



//VERIFY WALLET
$('.wallet').keyup(function(){
    let wallet=$(this).val();

    if(wallet.length>=6){

        $.post( 
                base_url+"verify-wallet", 
                {wallet_no:$(this).val()}, 
                function(data){

                    if(data=='Wallet number is not valid'){
                        $('.wallet').val(''); 
                        alerter_warning(data);

                    }
                }
        );
    }

     
});



//FEE CALCULATOR
function feeCaculator(amountInKobo){
    let fee=0.015* amountInKobo;
    if(amountInKobo>=250000){
        fee+=10000;
    }
    if(fee>200000){
        fee=200000;
    }
    return parseInt(Math.ceil(fee));
}







$('#fundWallet').submit(function(e){
    e.preventDefault();

    

    let fundAmount=Number($('#amount').val()*100);
    let amountToPay=fundAmount+ feeCaculator(fundAmount);

    var emailAddress=$('#emailAddress').val();
    var handler = PaystackPop.setup({
        key: 'pk_test_3e830b5c24356e4f58130e4537030eaeba2fc50b', 
        email: emailAddress,
        amount: amountToPay, 
        currency: 'NGN', 
        firstname: $('#name').val(),
        lastname: ' ',
        reference: $('#ref_no').val(), 
        metadata: {
                custom_fields: [
                    {
                        display_name: "USER NO",
                        variable_name: "user_no",
                        value: $('#user_no').val()
                    },
                    {
                        display_name: "WALLET NO",
                        variable_name: "wallet_no",
                        value: $('#wallet_no').val()
                    }
                ]
        },
        callback: function(response) {
          
          var reference = response.reference;
          $('.payButton').attr('disabled', true).html('<i class="fa fa-spinner fa-spin fa-fw"></i> Verifying your transaction.');
            $.post( 
                base_url+"verify", 
                {ref_no : reference, amount: fundAmount, wallet:$('#wallet_no').val() }, 
                function(data){

                    if(data=='Your wallet has been credited'){
                        alerter_success('Your Wallet has been credited with &#8358; '+ fundAmount/100, function(){location.href=base_url+'wallet';});
                    }
                    else{
                        alerter_warning(data);
                    }

                }
            );
            
        },
        onClose: function() {
          alert('Transaction was not completed, window closed.');
        },
    });
    handler.openIframe();



    
});







});
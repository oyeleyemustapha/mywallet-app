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



});